<?php

use model\Activity;
use model\ActivityDAO;
use model\ActivityEntry;
use model\ActivityEntryDAO;
use model\CalculDistanceImpl;

require_once(__ROOT__ . '/controllers/Controller.php');
require_once(__ROOT__ . '/model/ActivityEntryDAO.php');
require_once(__ROOT__ . '/model/ActivityDAO.php');
require_once(__ROOT__ . '/model/CalculDistanceImpl.php');
require_once(__ROOT__ . '/model/ActivityEntry.php');
require_once(__ROOT__ . '/model/Activity.php');

class UploadActivityController extends Controller
{
    /**
     * Rends le formulaire pour télécharger des activités.
     * 
     * Cette méthode est appelée lors d'une requête GET. Elle affiche 
     * le formulaire permettant à l'utilisateur de télécharger un fichier 
     * d'activité.
     *
     * @param array $request Les paramètres de la requête HTTP.
     * @return void
     */
    public function get($request): void
    {
        $this->render('upload_activity_form', []);
    }

    /**
     * Traite le fichier d'activité téléchargé, analyse son contenu 
     * et enregistre les données d'activité dans la base de données.
     * Si l'opération réussit, l'utilisateur est redirigé vers le panneau; 
     * sinon, un message d'erreur est affiché.
     * 
     * Cette méthode est appelée lors d'une requête POST. Elle vérifie 
     * si l'utilisateur est connecté, traite le fichier d'activité et 
     * gère les erreurs potentielles lors de l'upload ou de l'analyse des 
     * données.
     *
     * @param array $request Les paramètres de la requête HTTP.
     * @return void
     */
    public function post($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['email']) || !$_SESSION['email'] || !isset($_SESSION['password']) || !$_SESSION['password']) {
            $this->render('main', ['error' => 'ERREUR : Pas de session ouverte.']);
            return;
        }

        $activityEntryDAO = ActivityEntryDAO::getInstance();
        $activityDAO = ActivityDAO::getInstance();

        // Vérifier si un fichier a été téléchargé
        if (!isset($_FILES['file']) || $_FILES['file']['error'] != 0) {
            $this->render('upload_activity_form', ['error' => 'ERREUR : No file uploaded or there was an upload error.']);
            return;
        }

        try {
            // Lire et analyser le contenu du fichier JSON
            $data = json_decode(file_get_contents($_FILES['file']['tmp_name']), true);

            // Vérifier le format du fichier
            if (!isset($data['activity']) || !isset($data['data'])) {
                $this->render('upload_activity_form', ['error' => 'ERREUR : Invalid file format.']);
                return;
            }

            // Préparer les données d'activité
            $activityId = $activityDAO->getLastId();
            $userEmail = $_SESSION['email'];
            $description = $data['activity']['description'];
            $parcours = $data['data'];
            $distance = (new CalculDistanceImpl())->calculDistanceTrajet($parcours);

            $entryCount = count($data['data']);
            $startTime = $data['data'][0]['time'];
            $endTime = $data['data'][$entryCount - 1]['time'];
            $cardioFrequencyMin = $cardioFrequencyMax = $data['data'][0]['cardio_frequency'];
            $cardioFrequencySum = 0;

            // Enregistrer chaque entrée d'activité
            foreach ($data['data'] as $entry) {
                $activityEntry = new ActivityEntry();
                $activityEntry->init(0, $activityId, $entry['time'], $entry['cardio_frequency'], $entry['latitude'], $entry['longitude'], $entry['altitude']);
                $activityEntryDAO->insert($activityEntry);

                // Calculer la fréquence cardiaque min, max et la somme
                $cardioFrequencyMin = min($cardioFrequencyMin, $entry['cardio_frequency']);
                $cardioFrequencyMax = max($cardioFrequencyMax, $entry['cardio_frequency']);
                $cardioFrequencySum += $entry['cardio_frequency'];
            }

            // Calculer la durée de l'activité et la fréquence cardiaque moyenne
            $duration = (new DateTime($startTime))->diff(new DateTime($endTime))->s;
            $cardioFrequencyAverage = $cardioFrequencySum / $entryCount;

            // Créer et enregistrer l'activité
            $activity = new Activity();
            $activity->init(0, $userEmail, $data['activity']['date'], $startTime, $endTime, $duration, $description, $distance, $cardioFrequencyMin, $cardioFrequencyMax, $cardioFrequencyAverage);
            $activityDAO->insert($activity);

        } catch (TypeError $e) {
            $this->render('upload_activity_form', ['error' => 'ERREUR : Erreur lors de l\'upload du fichier.']);
            return;
        }

        // Rediriger vers le panneau après un succès
        $this->render('panel', []);
    }
}
