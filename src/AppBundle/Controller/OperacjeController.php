<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Operacje;
use AppBundle\Helper\KategorieTypes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/nieprzypisane", name="wyplatygotowkowe_nieprzypisane")
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
     * @Route("/nieprzypisane/{id}", name="wyplatygotowkowe_ustaw_kategorie")
     * @Method("GET")
     */
    public function ustawKategorieAction(Operacje $operacje)
    {
        $deleteForm = $this->createDeleteForm($operacje);

        return $this->render('operacje/ustawKategorie.html.twig', array(
            'operacje' => $operacje,
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Lists all operacje entities.
     *
     * @Route("/", name="wyplatygotowkowe_index")
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
     * @Route("/new", name="wyplatygotowkowe_new")
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

            return $this->redirectToRoute('wyplatygotowkowe_show', array('id' => $operacje->getId()));
        }

        return $this->render('operacje/new.html.twig', array(
            'operacje' => $operacje,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a operacje entity.
     *
     * @Route("/{id}", name="wyplatygotowkowe_show")
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
     * @Route("/{id}/edit", name="wyplatygotowkowe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Operacje $operacje)
    {
        $deleteForm = $this->createDeleteForm($operacje);
        $editForm = $this->createForm('AppBundle\Form\OperacjeType', $operacje);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wyplatygotowkowe_edit', array('id' => $operacje->getId()));
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
     * @Route("/{id}", name="wyplatygotowkowe_delete")
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

        return $this->redirectToRoute('wyplatygotowkowe_index');
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
            ->setAction($this->generateUrl('wyplatygotowkowe_delete', array('id' => $operacje->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
