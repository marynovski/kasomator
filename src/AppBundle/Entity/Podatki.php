<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Podatki
 *
 * @ORM\Table(name="podatki")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PodatkiRepository")
 */
class Podatki
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
     * @var int
     *
     * @ORM\Column(name="urzad", type="integer")
     */
    private $urzad;

    /**
     * @var int
     *
     * @ORM\Column(name="nasza_firma_id", type="integer")
     */
    private $naszaFirmaId;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="string", length=255)
     */
    private $opis;

    /**
     * @var string
     *
     * @ORM\Column(name="okres", type="string", length=255)
     */
    private $okres;

    /**
     * @var float
     *
     * @ORM\Column(name="kwota", type="float")
     */
    private $kwota;

    /**
     * @var bool
     *
     * @ORM\Column(name="czy_zaplacono", type="boolean")
     */
    private $czyZaplacono;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="termin_platnosci", type="datetime")
     */
    private $terminPlatnosci;


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
     * Set urzad
     *
     * @param integer $urzad
     *
     * @return Podatki
     */
    public function setUrzad($urzad)
    {
        $this->urzad = $urzad;

        return $this;
    }

    /**
     * Get urzad
     *
     * @return int
     */
    public function getUrzad()
    {
        return $this->urzad;
    }

    /**
     * Set naszaFirmaId
     *
     * @param integer $naszaFirmaId
     *
     * @return Podatki
     */
    public function setNaszaFirmaId($naszaFirmaId)
    {
        $this->naszaFirmaId = $naszaFirmaId;

        return $this;
    }

    /**
     * Get naszaFirmaId
     *
     * @return int
     */
    public function getNaszaFirmaId()
    {
        return $this->naszaFirmaId;
    }

    /**
     * Set opis
     *
     * @param string $opis
     *
     * @return Podatki
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;

        return $this;
    }

    /**
     * Get opis
     *
     * @return string
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * Set okres
     *
     * @param string $okres
     *
     * @return Podatki
     */
    public function setOkres($okres)
    {
        $this->okres = $okres;

        return $this;
    }

    /**
     * Get okres
     *
     * @return string
     */
    public function getOkres()
    {
        return $this->okres;
    }

    /**
     * Set kwota
     *
     * @param float $kwota
     *
     * @return Podatki
     */
    public function setKwota($kwota)
    {
        $this->kwota = $kwota;

        return $this;
    }

    /**
     * Get kwota
     *
     * @return float
     */
    public function getKwota()
    {
        return $this->kwota;
    }

    /**
     * Set czyZaplacono
     *
     * @param boolean $czyZaplacono
     *
     * @return Podatki
     */
    public function setCzyZaplacono($czyZaplacono)
    {
        $this->czyZaplacono = $czyZaplacono;

        return $this;
    }

    /**
     * Get czyZaplacono
     *
     * @return bool
     */
    public function getCzyZaplacono()
    {
        return $this->czyZaplacono;
    }

    /**
     * Set terminPlatnosci
     *
     * @param \DateTime $terminPlatnosci
     *
     * @return Podatki
     */
    public function setTerminPlatnosci($terminPlatnosci)
    {
        $this->terminPlatnosci = $terminPlatnosci;

        return $this;
    }

    /**
     * Get terminPlatnosci
     *
     * @return \DateTime
     */
    public function getTerminPlatnosci()
    {
        return $this->terminPlatnosci;
    }
}

