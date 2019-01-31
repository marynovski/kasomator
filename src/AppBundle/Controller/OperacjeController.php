<?php

namespace AppBundle\Controller;

use AppBundle\Entity\KontrahenciFaktur;
use AppBundle\Entity\Operacje;
use AppBundle\Form\OperacjaFakturaType;
use AppBundle\Helper\KategorieTypes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Operacje controller.
 *
 * @Route("operacje")
 */
class OperacjeController extends Controller
{
    /**
     * Lists all operacje entities.
     *
     * @Route("/nieprzypisane", name="operacje_nieprzypisane")
     * @Method("GET")
     */
    public function nieprzypisaneOperacjeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $operacjes = $em->getRepository('AppBundle:Operacje')->findBy(['kategoria' => KategorieTypes::NIEPRZYPISANA]);

        return $this->render('operacje/nieprzypisane.html.twig', array(
            'operacjes' => $operacjes,
        ));
    }

    /**
     * Lists all operacje entities.
     *
     * @Route("/nieprzypisane/{id}", name="operacje_ustaw_kategorie")
     * @Method({"GET", "POST"})
     */
    public function ustawKategorieAction(Operacje $operacje, Request $request)
    {
        $deleteForm = $this->createDeleteForm($operacje);




        $kontrahent = new KontrahenciFaktur();
        $form = $this->createForm('AppBundle\Form\OperacjaFakturaType', $kontrahent);
        $form->handleRequest($request);

        $form2 = $this->createForm('AppBundle\Form\OperacjaWynagrodzenieType');
        $form2->handleRequest($request);

        $form4 = $this->createForm('AppBundle\Form\OperacjaOplataBankowaType');
        $form4->handleRequest($request);

        if ($form2->isSubmitted() && $form2->isValid()) {

            $data = $form2->getData();

            $dataOd = $data['okresOd']->format('Y-m-d');
            $dataDo = $data['okresDo']->format('Y-m-d');

            $opis = $data['imieINazwisko'].' ';
            $opis .= 'od '.$dataOd.' ';
            $opis .= 'do '.$dataDo.' ';
            $opis .= $data['projekt']->getNazwa().' ';


            $operacje->getId();

            $em = $this->getDoctrine()->getManager();

            $operacja = $em->getRepository(Operacje::class)->find($operacje->getId());
            $operacja->setOpisAkcji($opis);
            $operacja->setKategoria(2);
            $em->flush();

            return $this->redirectToRoute('operacje_nieprzypisane');
        }

        if ($form4->isSubmitted() && $form4->isValid()) {

            $operacje->getId();

            $em = $this->getDoctrine()->getManager();

            $operacja = $em->getRepository(Operacje::class)->find($operacje->getId());
            $operacja->setKategoria(4);
            $em->flush();

            return $this->redirectToRoute('operacje_nieprzypisane');
        }


//        var_dump($request->request->all());
//        if (!empty($request->get('appbundle_operacjafaktura'))) {
//            $as = $this->get('tetranz_select2entity.autocomplete_service');
//            $result = $as->getAutocompleteResults($request, OperacjaFakturaType::class);
//            return new JsonResponse($result);
//        }

        return $this->render('operacje/ustawKategorie.html.twig', array(
            'operacje' => $operacje,
            'faktura_form' => $form->createView(),
            'wynagrodzenie_form' => $form2->createView(),
            'oplata_bankowa_form' => $form4->createView(),
        ));
    }



    /**
     * Lists all operacje entities.
     *
     * @Route("/", name="operacje_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $operacjes = $em->getRepository('AppBundle:Operacje')->findAll();

        return $this->render('operacje/index.html.twig', array(
            'operacjes' => $operacjes,
        ));
    }

    /**
     * Creates a new operacje entity.
     *
     * @Route("/new", name="operacje_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $operacje = new Operacje();
        $form = $this->createForm('AppBundle\Form\OperacjeType', $operacje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($operacje);
            $em->flush();

            return $this->redirectToRoute('operacje_show', array('id' => $operacje->getId()));
        }

        return $this->render('operacje/new.html.twig', array(
            'operacje' => $operacje,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a operacje entity.
     *
     * @Route("/{id}", name="operacje_show")
     * @Method("GET")
     */
    public function showAction(Operacje $operacje)
    {
        $deleteForm = $this->createDeleteForm($operacje);

        return $this->render('operacje/show.html.twig', array(
            'operacje' => $operacje,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing operacje entity.
     *
     * @Route("/{id}/edit", name="operacje_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Operacje $operacje)
    {
        $deleteForm = $this->createDeleteForm($operacje);
        $editForm = $this->createForm('AppBundle\Form\OperacjeType', $operacje);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operacje_edit', array('id' => $operacje->getId()));
        }

        return $this->render('operacje/edit.html.twig', array(
            'operacje' => $operacje,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a operacje entity.
     *
     * @Route("/{id}", name="operacje_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Operacje $operacje)
    {
        $form = $this->createDeleteForm($operacje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($operacje);
            $em->flush();
        }

        return $this->redirectToRoute('operacje_index');
    }

    /**
     * Creates a form to delete a operacje entity.
     *
     * @param Operacje $operacje The operacje entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Operacje $operacje)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('operacje_delete', array('id' => $operacje->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
