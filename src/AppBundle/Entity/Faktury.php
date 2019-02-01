<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faktury
 *
 * @ORM\Table(name="faktury")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FakturyRepository")
 */
class Faktury
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
     * @ORM\Column(name="rodzaj", type="integer")
     */
    private $rodzaj;

    /**
     * @var int
     *
     * @ORM\Column(name="nasza_firma_id", type="integer")
     */
    private $naszaFirmaId;

    /**
     * @var string
     *
     */
    private $kontrahentNip;

    /**
     * @var string
     *
     */
    private $kontrahentNazwa;

    /**
     * @var string
     *
     */
    private $kontrahentAdres;

    /**
     * @var string
     *
     */
    private $kontrahentMiasto;

    /**
     * @var string
     *
     */
    private $kontrahentKodPocztowy;

    /**
     *
     * @ORM\ManyToOne(targetEntity="KontrahenciFaktur")
     * @ORM\JoinColumn(name="kontrahent_id", referencedColumnName="id")
     */
    private $kontrahent;

    /**
     * @var string
     *
     * @ORM\Column(name="numer", type="string", length=255)
     */
    private $numer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_wystawienia", type="datetime")
     */
    private $dataWystawienia;

    /**
     * @var float
     *
     * @ORM\Column(name="kwota_netto", type="float")
     */
    private $kwotaNetto;

    /**
     * @var float
     *
     * @ORM\Column(name="kwota_brutto", type="float")
     */
    private $kwotaBrutto;

    /**
     * @var float
     *
     * @ORM\Column(name="kwota_vat", type="float")
     */
    private $kwotaVat;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="string", length=1000)
     */
    private $opis;

    /**
     * @var int
     *
     * @ORM\Column(name="forma_platnosci", type="integer")
     */
    private $formaPlatnosci;

    /**
     * @var string
     *
     * @ORM\Column(name="plik_skan_faktury", type="string", length=255, nullable=true)
     */
    private $plikSkanFaktury;

    /**
     * @var bool
     *
     * @ORM\Column(name="czy_zaplacono", type="boolean")
     */
    private $czyZaplacono;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="termin_platnosci", type="datetime", nullable=true)
     */
    private $terminPlatnosci;

    /**
     * @var int
     *
     * @ORM\Column(name="projekt", type="integer")
     */
    private $projekt;

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
     * Set rodzaj
     *
     * @param integer $rodzaj
     *
     * @return Faktury
     */
    public function setRodzaj($rodzaj)
    {
        $this->rodzaj = $rodzaj;

        return $this;
    }

    /**
     * Get rodzaj
     *
     * @return int
     */
    public function getRodzaj()
    {
        return $this->rodzaj;
    }

    /**
     * Set naszaFirmaId
     *
     * @param integer $naszaFirmaId
     *
     * @return Faktury
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
     * @return string
     */
    public function getKontrahentNip()
    {
        return $this->kontrahentNip;
    }

    /**
     * @param string $kontrahentNip
     */
    public function setKontrahentNip($kontrahentNip)
    {
        $this->kontrahentNip = $kontrahentNip;
    }

    /**
     * @return string
     */
    public function getKontrahentNazwa()
    {
        return $this->kontrahentNazwa;
    }

    /**
     * @param string $kontrahentNazwa
     */
    public function setKontrahentNazwa($kontrahentNazwa)
    {
        $this->kontrahentNazwa = $kontrahentNazwa;
    }

    /**
     * @return string
     */
    public function getKontrahentAdres()
    {
        return $this->kontrahentAdres;
    }

    /**
     * @param string $kontrahentAdres
     */
    public function setKontrahentAdres($kontrahentAdres)
    {
        $this->kontrahentAdres = $kontrahentAdres;
    }

    /**
     * @return string
     */
    public function getKontrahentMiasto()
    {
        return $this->kontrahentMiasto;
    }

    /**
     * @param string $kontrahentMiasto
     */
    public function setKontrahentMiasto($kontrahentMiasto)
    {
        $this->kontrahentMiasto = $kontrahentMiasto;
    }

    /**
     * @return string
     */
    public function getKontrahentKodPocztowy()
    {
        return $this->kontrahentKodPocztowy;
    }

    /**
     * @param string $kontrahentKodPocztowy
     */
    public function setKontrahentKodPocztowy($kontrahentKodPocztowy)
    {
        $this->kontrahentKodPocztowy = $kontrahentKodPocztowy;
    }

    /**
     * @return KontrahenciFaktur
     */
    public function getKontrahent()
    {
        return $this->kontrahent;
    }

    /**
     * @param KontrahenciFaktur $kontrahent
     */
    public function setKontrahent(KontrahenciFaktur $kontrahent)
    {
        $this->kontrahent = $kontrahent;
    }

    /**
     * Set numer
     *
     * @param string $numer
     *
     * @return Faktury
     */
    public function setNumer($numer)
    {
        $this->numer = $numer;

        return $this;
    }

    /**
     * Get numer
     *
     * @return string
     */
    public function getNumer()
    {
        return $this->numer;
    }

    /**
     * Set dataWystawienia
     *
     * @param \DateTime $dataWystawienia
     *
     * @return Faktury
     */
    public function setDataWystawienia($dataWystawienia)
    {
        $this->dataWystawienia = $dataWystawienia;

        return $this;
    }

    /**
     * Get dataWystawienia
     *
     * @return \DateTime
     */
    public function getDataWystawienia()
    {
        return $this->dataWystawienia;
    }

    /**
     * Set kwotaNetto
     *
     * @param float $kwotaNetto
     *
     * @return Faktury
     */
    public function setKwotaNetto($kwotaNetto)
    {
        $this->kwotaNetto = $kwotaNetto;

        return $this;
    }

    /**
     * Get kwotaNetto
     *
     * @return float
     */
    public function getKwotaNetto()
    {
        return $this->kwotaNetto;
    }

    /**
     * Set kwotaBrutto
     *
     * @param float $kwotaBrutto
     *
     * @return Faktury
     */
    public function setKwotaBrutto($kwotaBrutto)
    {
        $this->kwotaBrutto = $kwotaBrutto;

        return $this;
    }

    /**
     * Get kwotaBrutto
     *
     * @return float
     */
    public function getKwotaBrutto()
    {
        return $this->kwotaBrutto;
    }

    /**
     * Set kwotaVat
     *
     * @param float $kwotaVat
     *
     * @return Faktury
     */
    public function setKwotaVat($kwotaVat)
    {
        $this->kwotaVat = $kwotaVat;

        return $this;
    }

    /**
     * Get kwotaVat
     *
     * @return float
     */
    public function getKwotaVat()
    {
        return $this->kwotaVat;
    }

    /**
     * Set opis
     *
     * @param string $opis
     *
     * @return Faktury
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
     * Set formaPlatnosci
     *
     * @param integer $formaPlatnosci
     *
     * @return Faktury
     */
    public function setFormaPlatnosci($formaPlatnosci)
    {
        $this->formaPlatnosci = $formaPlatnosci;

        return $this;
    }

    /**
     * Get formaPlatnosci
     *
     * @return int
     */
    public function getFormaPlatnosci()
    {
        return $this->formaPlatnosci;
    }

    /**
     * Set plikSkanFaktury
     *
     * @param integer $plikSkanFaktury
     *
     * @return Faktury
     */
    public function setPlikSkanFaktury($plikSkanFaktury)
    {
        $this->plikSkanFaktury = $plikSkanFaktury;

        return $this;
    }

    /**
     * Get plikSkanFaktury
     *
     * @return int
     */
    public function getPlikSkanFaktury()
    {
        return $this->plikSkanFaktury;
    }

    /**
     * Set czyZaplacono
     *
     * @param boolean $czyZaplacono
     *
     * @return Faktury
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
     * @return \DateTime
     */
    public function getTerminPlatnosci()
    {
        return $this->terminPlatnosci;
    }

    /**
     * @param \DateTime $terminPlatnosci
     */
    public function setTerminPlatnosci($terminPlatnosci)
    {
        $this->terminPlatnosci = $terminPlatnosci;
    }

    /**
     * Set projekt
     *
     * @param integer $projekt
     *
     * @return Faktury
     */
    public function setProjekt($projekt)
    {
        $this->projekt = $projekt;

        return $this;
    }

    /**
     * Get projekt
     *
     * @return int
     */
    public function getProjekt()
    {
        return $this->projekt;
    }
}

