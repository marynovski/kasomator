<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Projekty;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Projekty controller.
 *
 * @Route("projekty")
 */
class ProjektyController extends Controller
{
    /**
     * Lists all projekty entities.
     *
     * @Route("/", name="projekty_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projekties = $em->getRepository('AppBundle:Projekty')->findAll();

        return $this->render('projekty/index.html.twig', array(
            'projekties' => $projekties,
        ));
    }

    /**
     * Creates a new projekty entity.
     *
     * @Route("/new", name="projekty_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $projekty = new Projekty();
        $form = $this->createForm('AppBundle\Form\ProjektyType', $projekty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projekty);
            $em->flush();

            return $this->redirectToRoute('projekty_show', array('id' => $projekty->getId()));
        }

        return $this->render('projekty/new.html.twig', array(
            'projekty' => $projekty,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projekty entity.
     *
     * @Route("/{id}", name="projekty_show")
     * @Method("GET")
     */
    public function showAction(Projekty $projekty)
    {
        $deleteForm = $this->createDeleteForm($projekty);

        return $this->render('projekty/show.html.twig', array(
            'projekty' => $projekty,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projekty entity.
     *
     * @Route("/{id}/edit", name="projekty_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Projekty $projekty)
    {
        $deleteForm = $this->createDeleteForm($projekty);
        $editForm = $this->createForm('AppBundle\Form\ProjektyType', $projekty);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projekty_edit', array('id' => $projekty->getId()));
        }

        return $this->render('projekty/edit.html.twig', array(
            'projekty' => $projekty,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projekty entity.
     *
     * @Route("/{id}", name="projekty_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Projekty $projekty)
    {
        $form = $this->createDeleteForm($projekty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projekty);
            $em->flush();
        }

        return $this->redirectToRoute('projekty_index');
    }

    /**
     * Creates a form to delete a projekty entity.
     *
     * @param Projekty $projekty The projekty entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Projekty $projekty)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projekty_delete', array('id' => $projekty->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
