<?php

namespace model;

class Activity
{
    private int $activityId;
    private string $userEmail;
    private string $activityDate;
    private string $startTime;
    private string $endTime;
    private float $duration;
    private string $description;
    private float $distance;
    private int $cardioFrequencyMin;
    private int $cardioFrequencyMax;
    private float $cardioFrequencyAverage;

    /**
     * Constructeur par defaut pour l'objet Activity.
     */
    public function  __construct() { }

    /**
     * Initialise l'activite avec les valeurs fournies.
     * @param int $ai ID de l'activite.
     * @param string $ue Email de l'utilisateur.
     * @param string $ad Date de l'activite.
     * @param string $st Heure de debut.
     * @param string $et Heure de fin.
     * @param float $du Duree de l'activite.
     * @param string $de Description de l'activite.
     * @param float $di Distance parcourue lors de l'activite.
     * @param int $cfMin Frequence cardiaque minimale enregistree.
     * @param int $cfMax Frequence cardiaque maximale enregistree.
     * @param float $cfAvg Frequence cardiaque moyenne.
     * @return void
     */
    public function init($ai, $ue, $ad, $st, $et, $du, $de, $di, $cfMin, $cfMax, $cfAvg): void
    {
        $this->activityId = $ai;
        $this->userEmail = $ue;
        $this->activityDate = $ad;
        $this->startTime = $st;
        $this->endTime = $et;
        $this->duration = $du;
        $this->description = $de;
        $this->distance = $di;
        $this->cardioFrequencyMin = $cfMin;
        $this->cardioFrequencyMax = $cfMax;
        $this->cardioFrequencyAverage = $cfAvg;
    }

    /**
     * Retourne l'ID de l'activite.
     * @return int
     */
    public function getActivityId(): int { return $this->activityId; }

    /**
     * Retourne l'email de l'utilisateur associe a l'activite.
     * @return string
     */
    public function getUserEmail(): string { return $this->userEmail; }

    /**
     * Retourne la date de l'activite.
     * @return string
     */
    public function getActivityDate(): string { return $this->activityDate; }

    /**
     * Retourne l'heure de debut de l'activite.
     * @return string
     */
    public function getStartTime(): string { return $this->startTime; }

    /**
     * Retourne l'heure de fin de l'activite.
     * @return string
     */
    public function getEndTime(): string { return $this->endTime; }

    /**
     * Retourne l'heure de fin de l'activite.
     * @return string
     */
    public function getDuration(): string { return $this->duration; }

    /**
     * Retourne la description de l'activite.
     * @return string
     */
    public function getDescription(): string { return $this->description; }

    /**
     * Retourne la distance parcourue lors de l'activite (arrondie a deux decimales).
     * @return string
     */
    public function getDistance(): string { return round($this->distance, 2); }

    /**
     * Retourne la frequence cardiaque minimale enregistree pendant l'activite.
     * @return int
     */
    public function getCardioFrequencyMin(): int { return $this->cardioFrequencyMin; }

    /**
     * Retourne la frequence cardiaque maximale enregistree pendant l'activite.
     * @return int
     */
    public function getCardioFrequencyMax(): int { return $this->cardioFrequencyMax; }

    /**
     * Retourne la frequence cardiaque moyenne de l'activite (arrondie a deux decimales).
     * @return float
     */
    public function getCardioFrequencyAverage(): float { return round($this->cardioFrequencyAverage, 2); }

    /**
     * Retourne une representation sous forme de chaine de caracteres de l'activite.
     * @return string
     */
    public function __toString(): string
    {
        return $this->activityId . " " . $this->userEmail . " " . $this->activityDate . " " . $this->startTime . " " . $this->endTime . " " . $this->duration . " " . $this->description . " " . $this->distance . " " . $this->cardioFrequencyMin . " " . $this->cardioFrequencyMax . " " . $this->cardioFrequencyAverage;
    }
}
