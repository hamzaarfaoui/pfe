<?php

namespace WorkBundle\Controller;

use WorkBundle\Entity\Medicaments;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Medicament controller.
 *
 * @Route("fournisseur/medicaments")
 */
class MedicamentsController extends Controller
{
    /**
     * Lists all medicament entities.
     *
     * @Route("/", name="fournisseur_medicaments_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $medicaments = $em->getRepository('WorkBundle:Medicaments')->findAll();

        return $this->render('medicaments/index.html.twig', array(
            'medicaments' => $medicaments,
        ));
    }

    /**
     * Creates a new medicament entity.
     *
     * @Route("/new", name="fournisseur_medicaments_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $medicament = new Medicaments();
        $form = $this->createForm('WorkBundle\Form\MedicamentsType', $medicament);
        $form->handleRequest($request);
        $fournisseur = $em->getRepository('WorkBundle:Fournisseurs')->findOneBy(array('user' => $this->getUser()));

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $medicament->setFounisseur($fournisseur);
            $em->persist($medicament);
            $em->flush();

            return $this->redirectToRoute('fournisseur_medicaments_show', array('id' => $medicament->getId()));
        }

        return $this->render('medicaments/new.html.twig', array(
            'medicament' => $medicament,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a medicament entity.
     *
     * @Route("/{id}", name="fournisseur_medicaments_show")
     * @Method("GET")
     */
    public function showAction(Medicaments $medicament)
    {
        $deleteForm = $this->createDeleteForm($medicament);

        return $this->render('medicaments/show.html.twig', array(
            'medicament' => $medicament,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing medicament entity.
     *
     * @Route("/{id}/edit", name="fournisseur_medicaments_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Medicaments $medicament)
    {
        $deleteForm = $this->createDeleteForm($medicament);
        $editForm = $this->createForm('WorkBundle\Form\MedicamentsType', $medicament);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fournisseur_medicaments_edit', array('id' => $medicament->getId()));
        }

        return $this->render('medicaments/edit.html.twig', array(
            'medicament' => $medicament,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a medicament entity.
     *
     * @Route("/{id}", name="fournisseur_medicaments_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Medicaments $medicament)
    {
        $form = $this->createDeleteForm($medicament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medicament);
            $em->flush();
        }

        return $this->redirectToRoute('fournisseur_medicaments_index');
    }

    /**
     * Creates a form to delete a medicament entity.
     *
     * @param Medicaments $medicament The medicament entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Medicaments $medicament)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fournisseur_medicaments_delete', array('id' => $medicament->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
