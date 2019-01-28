<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Faktury;
use AppBundle\Entity\Projekty;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\GusApi;
use GusApi\ReportTypes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * Lists all faktury entities.
     *
     * @Route("/", name="faktury_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $gus = new GusApi('a137213445434e769901');
//for development server use:
//$gus = new GusApi('abcde12345abcde12345', 'dev');

        try {
            $nipToCheck = '8943132676'; //change to valid nip value
            $gus->login();

            $gusReports = $gus->getByNip($nipToCheck);

            foreach ($gusReports as $gusReport) {
                //you can change report type to other one
                $reportType = ReportTypes::REPORT_PUBLIC_LAW;
                echo $gusReport->getName();
                $fullReport = $gus->getFullReport($gusReport, $reportType);
                var_dump($fullReport);
            }
        } catch (InvalidUserKeyException $e) {
            echo 'Bad user key';
        } catch (\GusApi\Exception\NotFoundException $e) {
            echo 'No data found <br>';
            echo 'For more information read server message below: <br>';
            echo $gus->getResultSearchMessage();
        }









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
        if (isset($_POST['valueKey'])) {
            $zaplacone = $_POST['valueKey'];
            echo $zaplacone;
            die();
        }


        $faktury = new Faktury();
        $form = $this->createForm('AppBundle\Form\FakturyType', $faktury);
        $form->handleRequest($request);

        $faktury->setProjekt(new Projekty());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($faktury);

            $rodzaj = $form["rodzaj"]->getData();
            $firma = $form["naszaFirmaId"]->getData();
            $firmaId = $firma->getId();
            var_dump($rodzaj);
            var_dump($firmaId);
            $em->flush();

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
