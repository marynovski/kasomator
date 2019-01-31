<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Faktury;
use AppBundle\Entity\KontrahenciFaktur;
use AppBundle\Entity\Projekty;
use AppBundle\Helper\FakturyTypes;
use AppBundle\Repository\FakturyRepository;
use AppBundle\Repository\KontrahenciFakturRepository;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\GusApi;
use GusApi\ReportTypes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Faktury controller.
 *
 * @Route("faktury")
 */
class FakturyController extends Controller
{

    /**
     * @Route("/stat_gov_nip", name="faktury_stat_gov_nip", options={"expose": true})
     * @param Request $request
     * @return JsonResponse
     */
    public function statGovNipAjaxAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException('Not XHR.');
        }
        $em = $this->getDoctrine()->getManager();

        $nip = $request->request->get('nip');

        $return_msg = ['msg' => 'FAIL'];

        if (!empty($nip)) {
            $gus = new GusApi('a137213445434e769901');
            $return_msg = ['msg' => 'OK'];
            try {
                $nipToCheck = $nip; //change to valid nip value
                $gus->login();

                $gusReports = $gus->getByNip($nipToCheck);

                foreach ($gusReports as $gusReport) {
                    //you can change report type to other one
                    $reportType = ReportTypes::REPORT_PUBLIC_LAW;
                    $fullReport = $gus->getFullReport($gusReport, $reportType);
//                    print_r($fullReport);

                    $return_msg['response'] = $fullReport[0];
                }
            } catch (InvalidUserKeyException $e) {}
              catch (\GusApi\Exception\NotFoundException $e) {
                  $return_msg['msg'] = $gus->getResultSearchMessage();
            }
        }

        return new JsonResponse($return_msg);
    }

    /**
     * @Route("/czy_zaplacono", name="faktury_czy_zaplacono", options={"expose": true})
     * @param Request $request
     * @return JsonResponse
     */
    public function czyZaplaconoAjaxAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException('Not XHR.');
        }
        $em = $this->getDoctrine()->getManager();

        $czyZaplacono = $request->request->get('czyZaplacono');
        if ($czyZaplacono == 0) {
            $return_msg['response'] = $fullReport[0];
        } else {
            $return_msg = ['msg' => 'FAIL'];
        }

        return new JsonResponse($return_msg);
    }

    /**
     * Lists all faktury entities.
     *
     * @Route("/", name="faktury_index")
     * @Method("GET")
     */
    public function indexAction()
    {

//        $gus = new GusApi('a137213445434e769901');
////for development server use:
////$gus = new GusApi('abcde12345abcde12345', 'dev');
//
//        try {
//            $nipToCheck = '8943132676'; //change to valid nip value
//            $gus->login();
//
//            $gusReports = $gus->getByNip($nipToCheck);
//
//            foreach ($gusReports as $gusReport) {
//                //you can change report type to other one
//                $reportType = ReportTypes::REPORT_PUBLIC_LAW;
////                echo $gusReport->getName();
//                $fullReport = $gus->getFullReport($gusReport, $reportType);
////                var_dump($fullReport);
//            }
//        } catch (InvalidUserKeyException $e) {
//            echo 'Bad user key';
//        } catch (\GusApi\Exception\NotFoundException $e) {
//            echo 'No data found <br>';
//            echo 'For more information read server message below: <br>';
//            echo $gus->getResultSearchMessage();
//        }









        $em = $this->getDoctrine()->getManager();

        $fakturies = $em->getRepository('AppBundle:Faktury')->findAll();

        return $this->render('faktury/index.html.twig', array(
            'fakturies' => $fakturies,
        ));
    }

    /**
     * Creates a new faktury entity.
     *
     * @Route("/new", name="faktury_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {



        $faktury = new Faktury();
        $form = $this->createForm('AppBundle\Form\FakturyType', $faktury);
        $form->handleRequest($request);

//        $faktury->setProjekt(new Projekty());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();


            if (!empty($_FILES['appbundle_faktury']) && $_FILES['appbundle_faktury']['size']['plikSkanFaktury'] > 0) {
                /** @var UploadedFile $file */
                $file = $faktury->getPlikSkanFaktury();
                $fileName = $this->get('faktury_uploader')->upload($file);
                $faktury->setPlikSkanFaktury($fileName);
            }

            $rodzaj                 = $form['rodzaj']->getData();

            $naszaFirmaId           = $form['naszaFirmaId']->getData()->getId();



            $numer                  = $form['numer']->getData();
            $dataWystawienia        = $form['dataWystawienia']->getData();


            $kwotaNetto             = $form['kwotaNetto']->getData();
            $kwotaBrutto            = $form['kwotaBrutto']->getData();
            $kwotaVat               = $form['kwotaVat']->getData();

            $opis                   = $form['opis']->getData();

            $formaPlatnosci         = $form['formaPlatnosci']->getData();

            $plikSkanFaktury        = $form['plikSkanFaktury']->getData();

            $czyZaplacono           = $form['czyZaplacono']->getData();
            $terminPlatnosci        = $form['terminPlatnosci']->getData();
            $projekt                = $form['projekt']->getData()->getId();

            $fakturyEntity = $faktury;
            $fakturyEntity->setNaszaFirmaId($naszaFirmaId);
//            $fakturyEntity->setKontrahentNip($kontrahentNip);
//            $fakturyEntity->setKontrahentNazwa($kontrahentNazwa);
//            $fakturyEntity->setKontrahentAdres($kontrahentAdres);
//            $fakturyEntity->setKontrahentMiasto($kontrahentMiasto);
//            $fakturyEntity->setKontrahentKodPocztowy($kontrahentKodPocztowy);
            $fakturyEntity->setNumer($numer);
            $fakturyEntity->setDataWystawienia($dataWystawienia);
//            $fakturyEntity->setKontrahentNrKonta($kontrahentNrKonta);
            $fakturyEntity->setRodzaj($rodzaj);

            if ($rodzaj == FakturyTypes::ZAGRANICZNA) {
                $fakturyEntity->setKwotaNetto($kwotaBrutto);
                $fakturyEntity->setKwotaBrutto($kwotaBrutto);
                $fakturyEntity->setKwotaVat(0);
            } else {
                $fakturyEntity->setKwotaNetto($kwotaNetto);
                $fakturyEntity->setKwotaBrutto($kwotaBrutto);
                $fakturyEntity->setKwotaVat($kwotaVat);
            }
            $fakturyEntity->setOpis($opis);
            $fakturyEntity->setFormaPlatnosci($formaPlatnosci);
//            $fakturyEntity->setPlikSkanFaktury(1);//PLIK = INTEGER?!



            $fakturyEntity->setCzyZaplacono($czyZaplacono);
            $fakturyEntity->setTerminPlatnosci($terminPlatnosci);
            $fakturyEntity->setProjekt($projekt);




            $kontrahentNip = $form['kontrahentNip']->getData();

            /** @var KontrahenciFakturRepository  $kfRepo */
            $kfRepo = $em->getRepository(KontrahenciFaktur::class);
            /** @var KontrahenciFaktur $kontrahent */
            $kontrahent = $kfRepo->findOneBy(['nip' => $kontrahentNip]);

            if (!($kontrahent instanceof KontrahenciFaktur)) {
                $kontrahent = new KontrahenciFaktur();
                $kontrahent->setNip($kontrahentNip);
                $kontrahent->setNazwa($form['kontrahentNazwa']->getData());
                $kontrahent->setAdres($form['kontrahentAdres']->getData());
                $kontrahent->setMiasto($form['kontrahentMiasto']->getData());
                $kontrahent->setKodPocztowy($form['kontrahentKodPocztowy']->getData());
                $kontrahent->setNrKonta($form['kontrahentNrKonta']->getData());

                $em->persist($kontrahent);
            }

            $fakturyEntity->setKontrahent($kontrahent);

            $em->persist($fakturyEntity);


            $em->flush();
            die('submitted');
            return $this->redirectToRoute('faktury_show', array('id' => $faktury->getId()));
        }

        return $this->render('faktury/new.html.twig', array(
            'faktury' => $faktury,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a faktury entity.
     *
     * @Route("/{id}", name="faktury_show")
     * @Method("GET")
     */
    public function showAction(Faktury $faktury)
    {
        $deleteForm = $this->createDeleteForm($faktury);

        return $this->render('faktury/show.html.twig', array(
            'faktury' => $faktury,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing faktury entity.
     *
     * @Route("/{id}/edit", name="faktury_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Faktury $faktury)
    {
        $deleteForm = $this->createDeleteForm($faktury);
        $editForm = $this->createForm('AppBundle\Form\FakturyType', $faktury);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('faktury_edit', array('id' => $faktury->getId()));
        }

        return $this->render('faktury/edit.html.twig', array(
            'faktury' => $faktury,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a faktury entity.
     *
     * @Route("/{id}", name="faktury_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Faktury $faktury)
    {
        $form = $this->createDeleteForm($faktury);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($faktury);
            $em->flush();
        }

        return $this->redirectToRoute('faktury_index');
    }

    /**
     * Creates a form to delete a faktury entity.
     *
     * @param Faktury $faktury The faktury entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Faktury $faktury)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('faktury_delete', array('id' => $faktury->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
