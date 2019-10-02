<?php

namespace WorkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WorkBundle\Entity\CommandesClient;
use WorkBundle\Entity\CommandesPharmacie;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $medicaments = $em->getRepository('WorkBundle:Medicaments')->findAll();
        return $this->render('WorkBundle:Default:index.html.twig',array(
            'medicaments' => $medicaments
        ));
    }
    
    public function commandesClientsAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $pharmacie = $em->getRepository('WorkBundle:Pharmacie')->findOneBy(array('user' => $this->getUser()));
        $comandes = $em->getRepository('WorkBundle:CommandesClient')->findAll();
        $comandes_list = array();
        foreach ($comandes as $comande){
            if($comande->getMedicament()->getPharmacie()->getId() == $pharmacie->getId()){
                $comandes_list[] = $comande;
            }
        }

        return $this->render('WorkBundle:Default:commandesClients.html.twig',array(
            'comandes' => $comandes_list
        ));
    }
    
    public function medicamentsPharmacieAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $medicaments = $em->getRepository('WorkBundle:Medicaments')->findAll();

        return $this->render('WorkBundle:Default:medicamentsPharmacie.html.twig',array(
            'medicaments' => $medicaments
        ));
    }
    
    public function commandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $medicament = $em->getRepository('WorkBundle:Medicaments')->find($id);
        $commande = new CommandesClient();
        $commande->setAmount($medicament->getPrice());
        $commande->setMedicament($medicament);
        $commande->setClient($this->getUser());
        $em->persist($commande);
        $medicament->setQuantite($medicament->getQuantite() - 1);
        $em->persist($medicament);
        $em->flush();
        return $this->redirectToRoute('work_homepage');
    }
    
    public function pharmaciePasseCommandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $pharmacie = $em->getRepository('WorkBundle:Pharmacie')->findOneBy(array('user' => $this->getUser()));
        $medicament = $em->getRepository('WorkBundle:Medicaments')->find($id);
        $commande = new CommandesPharmacie();
        $commande->setMedicament($medicament);
        $commande->setFournisseur($medicament->getFounisseur());
        $commande->setPharmacie($pharmacie);
        $em->persist($commande);
        $em->persist($medicament);
        $em->flush();
        return $this->redirectToRoute('medicaments_pharmacies');
    }
}
