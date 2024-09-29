<?php

use model\ActivityDAO;
use model\ActivityEntryDAO;
use model\UserDAO;

require_once(__ROOT__.'/controllers/Controller.php');
require_once(__ROOT__.'/model/ActivityDAO.php');
require_once(__ROOT__.'/model/ActivityEntryDAO.php');
require_once(__ROOT__.'/model/UserDAO.php');

class ListActivityController extends Controller
{
    /**
     * Renders the list of activities for the current user.
     * 
     * Cette méthode récupère et affiche la liste des activités pour l'utilisateur actuel.
     * 
     * @param array $request Les paramètres de la requête HTTP.
     * @return void
     */
    public function get($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['email']) || !$_SESSION['email'] || !isset($_SESSION['password']) || !$_SESSION['password']) {
            $this->render('main', ['error' => 'ERREUR : Pas de session ouverte.']);
            return;
        }

        $activityDAO = ActivityDAO::getInstance();
        $activityEntryDAO = ActivityEntryDAO::getInstance();
        $userDAO = UserDAO::getInstance();

        $user = $userDAO->find($_SESSION['email'], $_SESSION['password']);
        $activities = $activityDAO->findAllFromUser($user);

        $activitiesEntries = [];
        foreach ($activities as $index => $activity) {
            $activitiesEntries[$index] = $activityEntryDAO->findAllFromActivity($activity);
        }

        $this->render('list_activities', [
            'activities' => $activities,
            'activitiesEntries' => $activitiesEntries
        ]);
    }

    /**
     * Handles POST requests for deleting activities or activity entries.
     * 
     * Cette méthode traite les requêtes POST pour supprimer des activités ou des entrées d'activités.
     * 
     * @param array $request Les paramètres de la requête HTTP.
     * @return void
     */
    public function post($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['email']) || !$_SESSION['email'] || !isset($_SESSION['password']) || !$_SESSION['password']) {
            $this->render('main', ['error' => 'ERREUR : Pas de session ouverte.']);
            return;
        }

        $activityDAO = ActivityDAO::getInstance();
        $activityEntryDAO = ActivityEntryDAO::getInstance();

        if(isset($_POST['delete_activity'])) {
            $activity = $activityDAO->find($_POST['delete_activity']);
            $activityDAO->delete($activity);
        }
        if(isset($_POST['delete_activity_entry'])) {
            $activityEntry = $activityEntryDAO->find($_POST['delete_activity_entry']);
            $activityEntryDAO->delete($activityEntry);
        }

        $this->get($request);
    }
}