<?php

namespace AppBundle\Controller;

use AppBundle\Entity\NaszeFirmy;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Naszefirmy controller.
 *
 * @Route("naszefirmy")
 */
class NaszeFirmyController extends Controller
{
    /**
     * Lists all naszeFirmy entities.
     *
     * @Route("/", name="naszefirmy_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $naszeFirmies = $em->getRepository('AppBundle:NaszeFirmy')->findAll();

        return $this->render('naszefirmy/index.html.twig', array(
            'naszeFirmies' => $naszeFirmies,
        ));
    }

    /**
     * Creates a new naszeFirmy entity.
     *
     * @Route("/new", name="naszefirmy_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $naszeFirmy = new Naszefirmy();
        $form = $this->createForm('AppBundle\Form\NaszeFirmyType', $naszeFirmy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($naszeFirmy);
            $em->flush();

            return $this->redirectToRoute('naszefirmy_show', array('id' => $naszeFirmy->getId()));
        }

        return $this->render('naszefirmy/new.html.twig', array(
            'naszeFirmy' => $naszeFirmy,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a naszeFirmy entity.
     *
     * @Route("/{id}", name="naszefirmy_show")
     * @Method("GET")
     */
    public function showAction(NaszeFirmy $naszeFirmy)
    {
        $deleteForm = $this->createDeleteForm($naszeFirmy);

        return $this->render('naszefirmy/show.html.twig', array(
            'naszeFirmy' => $naszeFirmy,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing naszeFirmy entity.
     *
     * @Route("/{id}/edit", name="naszefirmy_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, NaszeFirmy $naszeFirmy)
    {
        $deleteForm = $this->createDeleteForm($naszeFirmy);
        $editForm = $this->createForm('AppBundle\Form\NaszeFirmyType', $naszeFirmy);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('naszefirmy_edit', array('id' => $naszeFirmy->getId()));
        }

        return $this->render('naszefirmy/edit.html.twig', array(
            'naszeFirmy' => $naszeFirmy,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a naszeFirmy entity.
     *
     * @Route("/{id}", name="naszefirmy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, NaszeFirmy $naszeFirmy)
    {
        $form = $this->createDeleteForm($naszeFirmy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($naszeFirmy);
            $em->flush();
        }

        return $this->redirectToRoute('naszefirmy_index');
    }

    /**
     * Creates a form to delete a naszeFirmy entity.
     *
     * @param NaszeFirmy $naszeFirmy The naszeFirmy entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(NaszeFirmy $naszeFirmy)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('naszefirmy_delete', array('id' => $naszeFirmy->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
