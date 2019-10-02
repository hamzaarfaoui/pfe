<?php

namespace WorkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandesPharmacie
 *
 * @ORM\Table(name="commandes_pharmacie")
 * @ORM\Entity(repositoryClass="WorkBundle\Repository\CommandesPharmacieRepository")
 */
class CommandesPharmacie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pharmacie", cascade={"remove", "persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $pharmacie;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Medicaments", cascade={"remove", "persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $medicament;
    
    /**
     * @ORM\ManyToOne(targetEntity="Fournisseurs", cascade={"remove", "persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $fournisseur;

    /**
     * @var array
     *
     * @ORM\Column(name="facture", type="array", nullable=true)
     */
    private $facture;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", nullable=true)
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set facture
     *
     * @param array $facture
     *
     * @return CommandesPharmacie
     */
    public function setFacture($facture)
    {
        $this->facture = $facture;

        return $this;
    }

    /**
     * Get facture
     *
     * @return array
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return CommandesPharmacie
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return CommandesPharmacie
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return CommandesPharmacie
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set pharmacie
     *
     * @param \WorkBundle\Entity\Pharmacie $pharmacie
     *
     * @return CommandesPharmacie
     */
    public function setPharmacie(\WorkBundle\Entity\Pharmacie $pharmacie = null)
    {
        $this->pharmacie = $pharmacie;

        return $this;
    }

    /**
     * Get pharmacie
     *
     * @return \WorkBundle\Entity\Pharmacie
     */
    public function getPharmacie()
    {
        return $this->pharmacie;
    }

    /**
     * Set fournisseur
     *
     * @param \WorkBundle\Entity\Fournisseurs $fournisseur
     *
     * @return CommandesPharmacie
     */
    public function setFournisseur(\WorkBundle\Entity\Fournisseurs $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \WorkBundle\Entity\Fournisseurs
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set medicament
     *
     * @param \WorkBundle\Entity\Medicaments $medicament
     *
     * @return CommandesPharmacie
     */
    public function setMedicament(\WorkBundle\Entity\Medicaments $medicament = null)
    {
        $this->medicament = $medicament;

        return $this;
    }

    /**
     * Get medicament
     *
     * @return \WorkBundle\Entity\Medicaments
     */
    public function getMedicament()
    {
        return $this->medicament;
    }
}
