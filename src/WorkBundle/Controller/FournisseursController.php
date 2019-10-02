<?php

namespace WorkBundle\Controller;

use WorkBundle\Entity\Fournisseurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fournisseur controller.
 *
 * @Route("fournisseurs/frzzg")
 */
class FournisseursController extends Controller
{
    /**
     * Lists all fournisseur entities.
     *
     * @Route("/liste", name="fournisseurs_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fournisseurs = $em->getRepository('WorkBundle:Fournisseurs')->findAll();

        return $this->render('fournisseurs/index.html.twig', array(
            'fournisseurs' => $fournisseurs,
        ));
    }
    
    /**
     * Lists all fournisseur entities.
     *
     * @Route("/commandes_pharmacies", name="commandes_pharmacies")
     * @Method("GET")
     */
    public function commandesPharmaciesAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $fournisseur = $em->getRepository('WorkBundle:Fournisseurs')->findOneBy(array('user' => $this->getUser()));
        $comandes = $em->getRepository('WorkBundle:CommandesPharmacie')->findBy(array('fournisseur' => $fournisseur));

        return $this->render('WorkBundle:Default:commandesPharmacies.html.twig',array(
            'comandes' => $comandes
        ));
    }

    /**
     * Creates a new fournisseur entity.
     *
     * @Route("/new", name="fournisseurs_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fournisseur = new Fournisseurs();
        $form = $this->createForm('WorkBundle\Form\FournisseursType', $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fournisseur);
            $em->flush();

            return $this->redirectToRoute('fournisseurs_show', array('id' => $fournisseur->getId()));
        }

        return $this->render('fournisseurs/new.html.twig', array(
            'fournisseur' => $fournisseur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fournisseur entity.
     *
     * @Route("/{id}", name="fournisseurs_show")
     * @Method("GET")
     */
    public function showAction(Fournisseurs $fournisseur)
    {
        $deleteForm = $this->createDeleteForm($fournisseur);

        return $this->render('fournisseurs/show.html.twig', array(
            'fournisseur' => $fournisseur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fournisseur entity.
     *
     * @Route("/{id}/edit", name="fournisseurs_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Fournisseurs $fournisseur)
    {
        $deleteForm = $this->createDeleteForm($fournisseur);
        $editForm = $this->createForm('WorkBundle\Form\FournisseursType', $fournisseur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fournisseurs_edit', array('id' => $fournisseur->getId()));
        }

        return $this->render('fournisseurs/edit.html.twig', array(
            'fournisseur' => $fournisseur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fournisseur entity.
     *
     * @Route("/{id}", name="fournisseurs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Fournisseurs $fournisseur)
    {
        $form = $this->createDeleteForm($fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fournisseur);
            $em->flush();
        }

        return $this->redirectToRoute('fournisseurs_index');
    }

    /**
     * Creates a form to delete a fournisseur entity.
     *
     * @param Fournisseurs $fournisseur The fournisseur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fournisseurs $fournisseur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fournisseurs_delete', array('id' => $fournisseur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
