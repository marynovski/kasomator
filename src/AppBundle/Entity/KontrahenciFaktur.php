<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KontrahenciFaktur
 *
 * @ORM\Table(name="kontrahenci_faktur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KontrahenciFakturRepository")
 */
class KontrahenciFaktur
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
     * @var string
     *
     * @ORM\Column(name="nip", type="string", length=255, unique=true)
     */
    private $nip;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa", type="string", length=255)
     */
    private $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="adres", type="string", length=255)
     */
    private $adres;

    /**
     * @var string
     *
     * @ORM\Column(name="miasto", type="string", length=255)
     */
    private $miasto;

    /**
     * @var string
     *
     * @ORM\Column(name="kod_pocztowy", type="string", length=255)
     */
    private $kodPocztowy;

    /**
     * @var string
     *
     * @ORM\Column(name="nr_konta", type="string", length=255)
     */
    private $nrKonta;


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
     * Set nip
     *
     * @param string $nip
     *
     * @return KontrahenciFaktur
     */
    public function setNip($nip)
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * Get nip
     *
     * @return string
     */
    public function getNip()
    {
        return $this->nip;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     *
     * @return KontrahenciFaktur
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Set adres
     *
     * @param string $adres
     *
     * @return KontrahenciFaktur
     */
    public function setAdres($adres)
    {
        $this->adres = $adres;

        return $this;
    }

    /**
     * Get adres
     *
     * @return string
     */
    public function getAdres()
    {
        return $this->adres;
    }

    /**
     * Set miasto
     *
     * @param string $miasto
     *
     * @return KontrahenciFaktur
     */
    public function setMiasto($miasto)
    {
        $this->miasto = $miasto;

        return $this;
    }

    /**
     * Get miasto
     *
     * @return string
     */
    public function getMiasto()
    {
        return $this->miasto;
    }

    /**
     * Set kodPocztowy
     *
     * @param string $kodPocztowy
     *
     * @return KontrahenciFaktur
     */
    public function setKodPocztowy($kodPocztowy)
    {
        $this->kodPocztowy = $kodPocztowy;

        return $this;
    }

    /**
     * Get kodPocztowy
     *
     * @return string
     */
    public function getKodPocztowy()
    {
        return $this->kodPocztowy;
    }

    /**
     * @return string
     */
    public function getNrKonta()
    {
        return $this->nrKonta;
    }

    /**
     * @param string $nrKonta
     */
    public function setNrKonta($nrKonta)
    {
        $this->nrKonta = $nrKonta;
    }


}

