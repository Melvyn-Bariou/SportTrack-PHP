<?php

namespace model;

class ActivityEntry
{
    private int $dataId;
    private int $activityId;
    private string $dataTime;
    private int $cardioFrequency;
    private float $latitude;
    private float $longitude;
    private float $altitude;

    /**
     * Constructeur par defaut pour ActivityEntry.
     */
    public function  __construct() { }

    /**
     * Initialise l'entree d'activite avec les valeurs donnees.
     * @param int $di ID de l'entree de donnees.
     * @param int $ai ID de l'activite.
     * @param string $dt Heure de la donnee.
     * @param int $cf Frequence cardiaque.
     * @param float $la Latitude.
     * @param float $lo Longitude.
     * @param float $al Altitude.
     * @return void
     */
    public function init($di, $ai, $dt, $cf, $la, $lo, $al): void
    {
        $this->dataId = $di;
        $this->activityId = $ai;
        $this->dataTime = $dt;
        $this->cardioFrequency = $cf;
        $this->latitude = $la;
        $this->longitude = $lo;
        $this->altitude = $al;
    }

    /**
     * Retourne l'ID de l'entree de donnees.
     * @return int
     */
    public function getDataId(): int { return $this->dataId; }

    /**
     * Retourne l'ID de l'activite associee a cette entree.
     * @return int
     */
    public  function getActivityId(): int { return $this->activityId; }

    /**
     * Retourne l'heure de l'entree de donnee.
     * @return string
     */
    public function getDataTime() { return $this->dataTime; }

    /**
     * Retourne la frequence cardiaque pour cette entree.
     * @return int
     */
    public function getCardioFrequency(): int { return $this->cardioFrequency; }

    /**
     * Retourne la valeur de la latitude pour cette entree.
     * @return float
     */
    public function getLatitude(): float { return $this->latitude; }

    /**
     * Retourne la valeur de la longitude pour cette entree.
     * @return float
     */
    public function getLongitude(): float { return $this->longitude; }

    /**
     * Retourne la valeur de l'altitude pour cette entree.
     * @return float
     */
    public function getAltitude(): float { return $this->altitude; }

    /**
     * Retourne une representation sous forme de chaine de caracteres de cet objet.
     * @return string
     */
    public function __toString(): string {
        return $this->dataId . " " . $this->activityId . " " . $this->dataTime . " " . $this->cardioFrequency . " " . $this->latitude . " " . $this->longitude . " " . $this->altitude;
    }
}