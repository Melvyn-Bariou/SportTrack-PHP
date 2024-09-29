<?php

namespace model;

use PDO;

require_once('SqliteConnection.php');
require_once('Activity.php');

class ActivityDAO
{
    private static ActivityDAO $dao;

    /**
     * Constructeur privé pour appliquer le pattern Singleton.
     */
    private function __construct() { }

    /**
     * Retourne l'instance singleton du ActivityDAO.
     * @return ActivityDAO L'instance de ActivityDAO.
     */
    public static function getInstance(): ActivityDAO
    {
        if (!isset(self::$dao)) {
            self::$dao = new ActivityDAO();
        }
        return self::$dao;
    }

    /**
     * Trouve et retourne toutes les activites de la base de donnees.
     * @return array Tableau d'objets Activity.
     */
    public final function findAll(): array
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT * FROM Activities";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, '\model\Activity');
        return $results;
    }

    /**
     * Trouve et retourne toutes les activites liees a un utilisateur specifique.
     * @param User $user L'utilisateur pour lequel on recupere les activites.
     * @return array Tableau d'objets Activity.
     */
    public final function findAllFromUser(User $user): array
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT * FROM Activities WHERE userEmail = :ue";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':ue', $user->getEmail(), PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, '\model\Activity');
        return $results;
    }

    /**
     * Insere une activite dans la base de donnees.
     * @param Activity $activity L'activite a inserer.
     * @return void
     */
    public final function insert(Activity $activity): void
    {
        if ($activity instanceof Activity) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "INSERT INTO Activities(userEmail, activityDate, startTime, endTime, duration, description, distance, cardioFrequencyMin, cardioFrequencyMax, cardioFrequencyAverage) 
                      VALUES (:ue, :ad, :st, :et, :du, :de, :di, :cfMin, :cfMax, :cfAvg)";
            $stmt = $dbc->prepare($query);

            $stmt->bindValue(':ue', $activity->getUserEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':ad', $activity->getActivityDate(), PDO::PARAM_STR);
            $stmt->bindValue(':st', $activity->getStartTime(), PDO::PARAM_STR);
            $stmt->bindValue(':et', $activity->getEndTime(), PDO::PARAM_STR);
            $stmt->bindValue(':du', $activity->getDuration(), PDO::PARAM_STR);
            $stmt->bindValue(':de', $activity->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':di', $activity->getDistance(), PDO::PARAM_STR);
            $stmt->bindValue(':cfMin', $activity->getCardioFrequencyMin(), PDO::PARAM_INT);
            $stmt->bindValue(':cfMax', $activity->getCardioFrequencyMax(), PDO::PARAM_INT);
            $stmt->bindValue(':cfAvg', $activity->getCardioFrequencyAverage(), PDO::PARAM_STR);

            $stmt->execute();
        }
    }

    /**
     * Supprime une activite de la base de donnees.
     * @param Activity $activity L'activite a supprimer.
     * @return void
     */
    public function delete(Activity $activity): void
    {
        if ($activity instanceof Activity) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "DELETE FROM Activities WHERE activityId = :ai";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':ai', $activity->getActivityId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    /**
     * Met a jour une activite dans la base de donnees.
     * @param Activity $activity L'activite avec les donnees mises a jour.
     * @return void
     */
    public function update(Activity $activity): void
    {
        if ($activity instanceof Activity) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "UPDATE Activities SET 
                      userEmail = :ue, 
                      activityDate = :ad,
                      startTime = :st,
                      endTime = :et,
                      duration = :du,
                      description = :de, 
                      distance = :di,
                      cardioFrequencyMin = :cfMin,
                      cardioFrequencyMax = :cfMax,
                      cardioFrequencyAverage = :cfAvg
                      WHERE activityId = :ai";

            $stmt = $dbc->prepare($query);

            $stmt->bindValue(':ue', $activity->getUserEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':ad', $activity->getActivityDate(), PDO::PARAM_STR);
            $stmt->bindValue(':st', $activity->getStartTime(), PDO::PARAM_STR);
            $stmt->bindValue(':et', $activity->getEndTime(), PDO::PARAM_STR);
            $stmt->bindValue(':du', $activity->getDuration(), PDO::PARAM_STR);
            $stmt->bindValue(':de', $activity->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':di', $activity->getDistance(), PDO::PARAM_STR);
            $stmt->bindValue(':cfMin', $activity->getCardioFrequencyMin(), PDO::PARAM_INT);
            $stmt->bindValue(':cfMax', $activity->getCardioFrequencyMax(), PDO::PARAM_INT);
            $stmt->bindValue(':cfAvg', $activity->getCardioFrequencyAverage(), PDO::PARAM_STR);
            $stmt->bindValue(':ai', $activity->getActivityId(), PDO::PARAM_INT);

            $stmt->execute();
        }
    }

    /**
     * Recupere le dernier ID d'activite de la base de donnees.
     * @return int Le dernier ID d'activite.
     */
    public function getLastId(): int {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT seq FROM sqlite_sequence WHERE name='Activities'";
        $stmt = $dbc->query($query);
        $result = $stmt->fetch();
        if ($result) {
            return $result['seq'] + 1;
        } else {
            return 1;
        }
    }


    /**
     * Trouve et retourne une activite de la base de donnees.
     * @param int $delete_activity L'ID de l'activite a trouver.
     * @return Activity|null L'activite trouvee ou null si elle n'existe pas.
     */
    public function find(int $delete_activity): ?Activity
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT * FROM Activities WHERE activityId = :ai";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':ai', $delete_activity, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchObject('\model\Activity');
        return $results;
    }
}
