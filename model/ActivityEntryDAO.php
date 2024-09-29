<?php

namespace model;

use PDO;

require_once('SqliteConnection.php');
require_once('User.php');

class ActivityEntryDAO
{
    private static ActivityEntryDAO $dao;

    /**
     * Constructeur privé pour le modèle singleton.
     */
    private function __construct() { }

    /**
     * Retourne une instance de ActivityEntryDAO.
     * @return ActivityEntryDAO
     */
    public static function getInstance(): ActivityEntryDAO
    {
        if (!isset(self::$dao)) {
            self::$dao = new ActivityEntryDAO();
        }
        return self::$dao;
    }

    /**
     * Récupère toutes les entrées d'activités de la base de données.
     * @return array Un tableau d'objets ActivityEntry.
     */
    public final function findAll(): array
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Data";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchALL(PDO::FETCH_CLASS, '\model\ActivityEntry');
        return $results;
    }

    /**
     * Récupère toutes les entrées d'une activité spécifique depuis la base de données.
     * @param Activity $activity L'activité pour laquelle récupérer les entrées.
     * @return array Un tableau d'objets ActivityEntry liés à l'activité donnée.
     */
    public final function findAllFromActivity(Activity $activity)
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Data where activityId = :ai";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':ai', $activity->getActivityId());
        $stmt->execute();
        $results = $stmt->fetchALL(PDO::FETCH_CLASS, '\model\ActivityEntry');
        return $results;
    }

    /**
     * Insère une nouvelle entrée d'activité dans la base de données.
     * @param ActivityEntry $entry L'entrée d'activité à insérer.
     * @return void
     */
    public final function insert(ActivityEntry $entry): void
    {
        if ($entry instanceof ActivityEntry) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "insert into Data(activityId, dataTime, cardioFrequency, latitude, longitude, altitude) values (:ai, :dt, :cf, :la, :lo, :al)";
            $stmt = $dbc->prepare($query);

            $stmt->bindValue(':ai', $entry->getActivityId(), PDO::PARAM_STR);
            $stmt->bindValue(':dt', $entry->getDataTime(), PDO::PARAM_STR);
            $stmt->bindValue(':cf', $entry->getCardioFrequency(), PDO::PARAM_STR);
            $stmt->bindValue(':la', $entry->getLatitude(), PDO::PARAM_STR);
            $stmt->bindValue(':lo', $entry->getLongitude(), PDO::PARAM_STR);
            $stmt->bindValue(':al', $entry->getAltitude(), PDO::PARAM_STR);

            $stmt->execute();
        }
    }

    /**
     * Supprime une entrée d'activité de la base de données.
     * @param ActivityEntry $entry L'entrée d'activité à supprimer.
     * @return void
     */
    public function delete(ActivityEntry $entry): void
    {
        if($entry instanceof ActivityEntry) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "delete from Data where dataId = :di";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':di', $entry->getDataId(), PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    /**
     * Met à jour une entrée d'activité existante dans la base de données.
     * @param ActivityEntry $entry L'entrée d'activité avec les nouvelles valeurs.
     * @return void
     */
    public function update(ActivityEntry $entry): void
    {
        if($entry instanceof ActivityEntry) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "update Data set activityId = :ai, dataTime = :dt, cardioFrequency = :cf, latitude = :la, longitude = :lo, altitude = :al where dataId = :di";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':ai', $entry->getActivityId(), PDO::PARAM_STR);
            $stmt->bindValue(':dt', $entry->getDataTime(), PDO::PARAM_STR);
            $stmt->bindValue(':cf', $entry->getCardioFrequency(), PDO::PARAM_STR);
            $stmt->bindValue(':la', $entry->getLatitude(), PDO::PARAM_STR);
            $stmt->bindValue(':lo', $entry->getLongitude(), PDO::PARAM_STR);
            $stmt->bindValue(':al', $entry->getAltitude(), PDO::PARAM_STR);
            $stmt->bindValue(':di', $entry->getDataId(), PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    /**
     * Récupère une entrée d'activité à partir de son ID.
     * @param int $dataId L'ID de l'entrée d'activité à récupérer.
     * @return ActivityEntry|null L'entrée d'activité si elle est trouvée, null sinon.
     */
    public function find(int $dataId): ?ActivityEntry
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Data where dataId = :di";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':di', $dataId);
        $stmt->execute();
        $result = $stmt->fetchObject('\model\ActivityEntry');
        return $result;
    }
}