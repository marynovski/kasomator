<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Podatki;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Podatki controller.
 *
 * @Route("podatki")
 */
class PodatkiController extends Controller
{
    /**
     * Lists all podatki entities.
     *
     * @Route("/", name="podatki_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $podatkis = $em->getRepository('AppBundle:Podatki')->findAll();

        return $this->render('podatki/index.html.twig', array(
            'podatkis' => $podatkis,
        ));
    }

    /**
     * Creates a new podatki entity.
     *
     * @Route("/new", name="podatki_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $podatki = new Podatki();
        $form = $this->createForm('AppBundle\Form\PodatkiType', $podatki);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


//            print_r($request->request->all());die();

            $firmaId = $request->request->get('appbundle_podatki')['naszaFirmaId'];

            $podatki->setNaszaFirmaId($firmaId);

            $em = $this->getDoctrine()->getManager();
            $em->persist($podatki);
            $em->flush();

            return $this->redirectToRoute('podatki_show', array('id' => $podatki->getId()));
        }

        return $this->render('podatki/new.html.twig', array(
            'podatki' => $podatki,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a podatki entity.
     *
     * @Route("/{id}", name="podatki_show")
     * @Method("GET")
     */
    public function showAction(Podatki $podatki)
    {
        $deleteForm = $this->createDeleteForm($podatki);

        return $this->render('podatki/show.html.twig', array(
            'podatki' => $podatki,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing podatki entity.
     *
     * @Route("/{id}/edit", name="podatki_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Podatki $podatki)
    {
        $deleteForm = $this->createDeleteForm($podatki);
        $editForm = $this->createForm('AppBundle\Form\PodatkiType', $podatki);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('podatki_edit', array('id' => $podatki->getId()));
        }

        return $this->render('podatki/edit.html.twig', array(
            'podatki' => $podatki,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a podatki entity.
     *
     * @Route("/{id}", name="podatki_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Podatki $podatki)
    {
        $form = $this->createDeleteForm($podatki);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($podatki);
            $em->flush();
        }

        return $this->redirectToRoute('podatki_index');
    }

    /**
     * Creates a form to delete a podatki entity.
     *
     * @param Podatki $podatki The podatki entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Podatki $podatki)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('podatki_delete', array('id' => $podatki->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
