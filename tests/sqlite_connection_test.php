<?php

use model\ActivityEntry;
use model\ActivityEntryDAO;
use model\User;
use model\UserDAO;
use model\Activity;
use model\ActivityDAO;

if (!defined('__ROOT__')) {
    define("__ROOT__", dirname(__DIR__));  // Remonte d'un niveau pour accéder au dossier racine du projet
}

require_once('../config.php');
require_once(__ROOT__.'/model/User.php');
require_once(__ROOT__.'/model/UserDAO.php');
require_once(__ROOT__.'/model/Activity.php');
require_once(__ROOT__.'/model/ActivityDAO.php');
require_once(__ROOT__.'/model/ActivityEntry.php');
require_once(__ROOT__.'/model/ActivityEntryDAO.php');
require_once(__ROOT__.'/model/SqliteConnection.php');

const DB_FILE = __ROOT__.'/db/sport_track.db';

// Fonction pour vider les tables
function clearDatabase($userDAO, $activityDAO, $activityEntryDAO) {
    // Suppression de toutes les entrées dans ActivityEntry
    foreach ($activityEntryDAO->findAll() as $entry) {
        $activityEntryDAO->delete($entry);
        echo "Entrée supprimée de ActivityEntry: " . json_encode($entry) . "\n"; // Afficher l'entrée supprimée
    }

    // Suppression de toutes les entrées dans Activity
    foreach ($activityDAO->findAll() as $activity) {
        $activityDAO->delete($activity);
        echo "Activité supprimée: " . json_encode($activity) . "\n"; // Afficher l'activité supprimée
    }

    // Suppression de toutes les entrées dans User
    foreach ($userDAO->findAll() as $user) {
        $userDAO->delete($user);
        echo "Utilisateur supprimé: " . json_encode($user) . "\n"; // Afficher l'utilisateur supprimé
    }
}

// User
print("User\n");
$userDAO = UserDAO::getInstance();

// Vider les données existantes
clearDatabase($userDAO, ActivityDAO::getInstance(), ActivityEntryDAO::getInstance());

// Insert User
echo "\n--- Test : Insertion d'un nouvel utilisateur ---\n";
$newUser = new User();
$newUser->init('alice.smith@example.com', 'securepassword', 'Alice', 'Smith', '1995-05-20', 'F', 165.0, 55.0);
$userDAO->insert($newUser);

$allUsers = $userDAO->findAll();
foreach ($allUsers as $user) {
    print($user."\n");
}

// Update User
echo "\n--- Test : Mise à jour de l'utilisateur ---\n";
$updateUser = new User();
$updateUser->init('alice.smith@example.com', 'securepassword', 'Alice', 'Smith', '1995-05-20', 'F', 170.0, 55.0);
$userDAO->update($updateUser);

$allUsers = $userDAO->findAll();
foreach ($allUsers as $user) {
    print($user."\n");
}

// Delete User
echo "\n--- Test : Suppression de l'utilisateur ---\n";
$deleteUser = new User();
$deleteUser->init('alice.smith@example.com', '', '', '', '', '', 0, 0);
$userDAO->delete($deleteUser);

$allUsers = $userDAO->findAll();
foreach ($allUsers as $user) {
    print($user."\n");
}

// Activity
print("Activity\n");
$activityDAO = ActivityDAO::getInstance();

// Insert Activity
echo "\n--- Test : Insertion d'une nouvelle activité ---\n";
$newActivity = new Activity();
$newActivity->init(1, 'alice.smith@example.com', '2024-01-10', '10:00:00', '11:00:00', 60.0, 'Cycling', 15.0, 90, 140, 110);
$activityDAO->insert($newActivity);

$allActivities = $activityDAO->findAll();
foreach ($allActivities as $activity) {
    print($activity."\n");
}

// Update Activity
echo "\n--- Test : Mise à jour de l'activité ---\n";
$updateActivity = new Activity();
$updateActivity->init(1, 'alice.smith@example.com', '2024-01-10', '10:00:00', '11:30:00', 90.0, 'Updated Cycling', 16.0, 95, 145, 115);
$activityDAO->update($updateActivity);

$allActivities = $activityDAO->findAll();
foreach ($allActivities as $activity) {
    print($activity."\n");
}

// Delete Activity
echo "\n--- Test : Suppression de l'activité ---\n";
$deleteActivity = new Activity();
$deleteActivity->init(1, 'alice.smith@example.com', '2024-01-10', '10:00:00', '11:00:00', 60.0, 'Cycling', 15.0, 90, 140, 110);
$activityDAO->delete($deleteActivity);

$allActivities = $activityDAO->findAll();
foreach ($allActivities as $activity) {
    print($activity."\n");
}

// ActivityEntry
print("ActivityEntry\n");
$activityEntryDAO = ActivityEntryDAO::getInstance();

// Insert ActivityEntry
echo "\n--- Test : Insertion d'une nouvelle entrée d'activité ---\n";
$newEntry = new ActivityEntry();
$newEntry->init(1, 1, '2024-01-10 10:01:00', 75, 37.7749, -122.4194, 5.5);
$activityEntryDAO->insert($newEntry);

$allEntries = $activityEntryDAO->findAll();
foreach ($allEntries as $entry) {
    print($entry."\n");
}

// Update ActivityEntry
echo "\n--- Test : Mise à jour de l'entrée d'activité ---\n";
$updateEntry = new ActivityEntry();
$updateEntry->init(1, 1, '2024-01-10 10:02:00', 80, 37.7749, -122.4194, 6.0);
$activityEntryDAO->update($updateEntry);

$allEntries = $activityEntryDAO->findAll();
foreach ($allEntries as $entry) {
    print($entry."\n");
}

// Delete ActivityEntry
echo "\n--- Test : Suppression de l'entrée d'activité ---\n";
$deleteEntry = new ActivityEntry();
$deleteEntry->init(1, 1, '2024-01-10 10:01:00', 75, 37.7749, -122.4194, 5.5);
$activityEntryDAO->delete($deleteEntry);

$allEntries = $activityEntryDAO->findAll();
foreach ($allEntries as $entry) {
    print($entry."\n");
}
