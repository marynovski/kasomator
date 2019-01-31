<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Operacje;
use AppBundle\Form\ZaladujWyciagBankowy;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Wyciagibankowe controller.
 *
 * @Route("wyciagibankowe")
 */
class WyciagiBankoweController extends Controller
{
    /**
     * Lists all wyciagiBankowe entities.
     *
     * @Route("/", name="wyciagibankowe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $wyciagiBankowes = $em->getRepository('AppBundle:Operacje')->findAll();

        return $this->render('operacje/index.html.twig', array(
            'wyciagiBankowes' => $wyciagiBankowes,
        ));
    }


    /**
     * Creates a new wyciagiBankowe entity.
     *
     * @Route("/zaladuj_plik", name="operacje_zaladuj_plik")
     * @Method({"GET", "POST"})
     */
    public function zaladujPlikAction(Request $request)
    {
        $wyciagiBankowe = new Operacje();
        $form = $this->createForm(ZaladujWyciagBankowy::class, $wyciagiBankowe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            print_r($_FILES)
                 //checks that file is uploaded
            $dane_wyciagu_bankowego = file($_FILES['appbundle_wyciagibankowe']['tmp_name']['plik_wyciagu_bankowego']);
//            var_dump($dane_wyciagu_bankowego);die();
            if(empty($dane_wyciagu_bankowego)){
                die("Brak danych");
            }

            /** @var $wyciagBankowyManager \AppBundle\Manager\WyciagBankowy */
            $wyciagBankowyManager = $this->get('app.manager.wyciagbankowy');
            var_dump($wyciagBankowyManager->parsowanieDanych($dane_wyciagu_bankowego));

            die("form submitted");
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($wyciagiBankowe);
//            $em->flush();
//
//            return $this->redirectToRoute('wyciagibankowe_show', array('id' => $wyciagiBankowe->getId()));
        }

        return $this->render('operacje/upload.html.twig', array(
            'wyciagiBankowe' => $wyciagiBankowe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new wyciagiBankowe entity.
     *
     * @Route("/new", name="wyciagibankowe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $wyciagiBankowe = new Operacje();
        $form = $this->createForm('AppBundle\Form\WyciagiBankoweType', $wyciagiBankowe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wyciagiBankowe);
            $em->flush();

            return $this->redirectToRoute('wyciagibankowe_show', array('id' => $wyciagiBankowe->getId()));
        }

        return $this->render('operacje/new.html.twig', array(
            'wyciagiBankowe' => $wyciagiBankowe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a wyciagiBankowe entity.
     *
     * @Route("/{id}", name="wyciagibankowe_show")
     * @Method("GET")
     */
    public function showAction(Operacje $wyciagiBankowe)
    {
        $deleteForm = $this->createDeleteForm($wyciagiBankowe);

        return $this->render('operacje/show.html.twig', array(
            'wyciagiBankowe' => $wyciagiBankowe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing wyciagiBankowe entity.
     *
     * @Route("/{id}/edit", name="wyciagibankowe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Operacje $wyciagiBankowe)
    {
        $deleteForm = $this->createDeleteForm($wyciagiBankowe);
        $editForm = $this->createForm('AppBundle\Form\WyciagiBankoweType', $wyciagiBankowe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wyciagibankowe_edit', array('id' => $wyciagiBankowe->getId()));
        }

        return $this->render('operacje/edit.html.twig', array(
            'wyciagiBankowe' => $wyciagiBankowe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a wyciagiBankowe entity.
     *
     * @Route("/{id}", name="wyciagibankowe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Operacje $wyciagiBankowe)
    {
        $form = $this->createDeleteForm($wyciagiBankowe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($wyciagiBankowe);
            $em->flush();
        }

        return $this->redirectToRoute('wyciagibankowe_index');
    }

    /**
     * Creates a form to delete a wyciagiBankowe entity.
     *
     * @param Operacje $wyciagiBankowe The wyciagiBankowe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Operacje $wyciagiBankowe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wyciagibankowe_delete', array('id' => $wyciagiBankowe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
