<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WyciagiBankowe
 *
 * @ORM\Table(name="operacje")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OperacjeRepository")
 */
class Operacje
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
     * @ORM\Column(name="type", type="integer", options={"default" : 1})
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_operacji", type="datetime")
     */
    private $dataOperacji;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_ksiegowania", type="datetime")
     */
    private $dataKsiegowania;

    /**
     * @var int
     *
     * @ORM\Column(name="opis_operacji", type="integer")
     */
    private $opisOperacji;

    /**
     * @var string
     *
     * @ORM\Column(name="tytul", type="string", length=500)
     */
    private $tytul;

    /**
     * @var string
     *
     * @ORM\Column(name="kontrahent", type="string", length=10000)
     */
    private $kontrahent;
    /**
     * @var string
     *
     * @ORM\Column(name="nr_konta", type="string", length=255)
     */
    private $nrKonta;

    /**
     * @var float
     *
     * @ORM\Column(name="kwota", type="float")
     */
    private $kwota;

    /**
     * @var float
     *
     * @ORM\Column(name="saldo_po_operacji", type="float")
     */
    private $saldoPoOperacji;

    /**
     * not mapped
     * @var
     */
    private $plikWyciaguBankowego;

    /**
     * @var int
     *
     * @ORM\Column(name="kategoria", type="integer")
     */
    private $kategoria;

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
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Set dataOperacji
     *
     * @param \DateTime $dataOperacji
     *
     * @return Operacje
     */
    public function setDataOperacji($dataOperacji)
    {
        $this->dataOperacji = $dataOperacji;

        return $this;
    }

    /**
     * Get dataOperacji
     *
     * @return \DateTime
     */
    public function getDataOperacji()
    {
        return $this->dataOperacji;
    }

    /**
     * Set dataKsiegowania
     *
     * @param \DateTime $dataKsiegowania
     *
     * @return Operacje
     */
    public function setDataKsiegowania($dataKsiegowania)
    {
        $this->dataKsiegowania = $dataKsiegowania;

        return $this;
    }

    /**
     * Get dataKsiegowania
     *
     * @return \DateTime
     */
    public function getDataKsiegowania()
    {
        return $this->dataKsiegowania;
    }

    /**
     * Set opisOperacji
     *
     * @param integer $opisOperacji
     *
     * @return Operacje
     */
    public function setOpisOperacji($opisOperacji)
    {
        $this->opisOperacji = $opisOperacji;

        return $this;
    }

    /**
     * Get opisOperacji
     *
     * @return int
     */
    public function getOpisOperacji()
    {
        return $this->opisOperacji;
    }

    /**
     * Set tytul
     *
     * @param string $tytul
     *
     * @return Operacje
     */
    public function setTytul($tytul)
    {
        $this->tytul = $tytul;

        return $this;
    }

    /**
     * Get tytul
     *
     * @return string
     */
    public function getTytul()
    {
        return $this->tytul;
    }

    /**
     * @return string
     */
    public function getKontrahent()
    {
        return $this->kontrahent;
    }

    /**
     * @param string $kontrahent
     */
    public function setKontrahent($kontrahent)
    {
        $this->kontrahent = $kontrahent;
    }

    /**
     * Set nrKonta
     *
     * @param string $nrKonta
     *
     * @return Operacje
     */
    public function setNrKonta($nrKonta)
    {
        $this->nrKonta = $nrKonta;

        return $this;
    }

    /**
     * Get nrKonta
     *
     * @return string
     */
    public function getNrKonta()
    {
        return $this->nrKonta;
    }

    /**
     * Set kwota
     *
     * @param float $kwota
     *
     * @return Operacje
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
     * Set saldoPoOperacji
     *
     * @param float $saldoPoOperacji
     *
     * @return Operacje
     */
    public function setSaldoPoOperacji($saldoPoOperacji)
    {
        $this->saldoPoOperacji = $saldoPoOperacji;

        return $this;
    }

    /**
     * Get saldoPoOperacji
     *
     * @return float
     */
    public function getSaldoPoOperacji()
    {
        return $this->saldoPoOperacji;
    }

    /**
     * @return mixed
     */
    public function getPlikWyciaguBankowego()
    {
        return $this->plikWyciaguBankowego;
    }

    /**
     * @param mixed $plikWyciaguBankowego
     */
    public function setPlikWyciaguBankowego($plikWyciaguBankowego)
    {
        $this->plikWyciaguBankowego = $plikWyciaguBankowego;
    }

    /**
     * @return int
     */
    public function getKategoria()
    {
        return $this->kategoria;
    }

    /**
     * @param int $kategoria
     */
    public function setKategoria($kategoria)
    {
        $this->kategoria = $kategoria;
    }




}

