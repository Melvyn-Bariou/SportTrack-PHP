<?php

use model\User;
use model\UserDAO;

require_once(__ROOT__ . '/controllers/Controller.php');
require_once(__ROOT__ . '/model/User.php');
require_once(__ROOT__ . '/model/UserDAO.php');

class EditUserController extends Controller
{
    /**
     * Récupère les détails de l'utilisateur depuis la base de données et affiche le formulaire de modification de l'utilisateur.
     * Si aucun utilisateur valide n'est trouvé, affiche la page principale avec un message d'erreur.
     * 
     * @param array $request Les paramètres de la requête HTTP.
     * @return void
     */
    public function get($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userDAO = UserDAO::getInstance();
        $user = $userDAO->find($_SESSION['email'], $_SESSION['password']);
        if (!$user) {
            $this->render('main', ['error' => 'ERREUR : Email or password incorrect']);
            return;
        }

        $this->render('user_edit_form', ['user' => $user]);
    }

    /**
     * Gère la requête POST pour modifier les détails d'un utilisateur.
     * Si l'action 'delete' est choisie, l'utilisateur est supprimé de la base de données et la session est terminée.
     * Si l'action 'save' est choisie, les détails de l'utilisateur sont mis à jour dans la base de données.
     * Si aucune session valide n'existe, affiche la page principale avec un message d'erreur.
     * 
     * @param array $request Les paramètres de la requête HTTP, qui peuvent inclure un choix d'action (delete/save) et les détails de l'utilisateur.
     * @return void
     */
    public function post($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['email']) || !$_SESSION['email'] || !isset($_SESSION['password']) || !$_SESSION['password']) {
            $this->render('main', ['error' => 'ERREUR : Pas de session ouverte.']);
            return;
        }

        $userDAO = UserDAO::getInstance();

        try {
            if ($request['action'] == 'delete') {
                // Trouve l'utilisateur dans la base de données
                $user = $userDAO->find($_SESSION['email'], $_SESSION['password']);
                // Supprime l'utilisateur
                $userDAO->delete($user);
                // Détruit la session et redirige vers la page principale
                session_destroy();
                $this->render('main', []);
            } else if ($request['action'] == 'save') {
                $user = new User();
                $password = isset($request['password']) && $request['password'] ? $request['password'] : $_SESSION['password'];
                $user->init($_SESSION['email'], $password, $request['firstname'], $request['lastname'], $request['birthdate'], $request['gender'], $request['height'], $request['weight']);
                $userDAO->update($user);
                $this->render('panel', []);
            }
        } catch (Exception $e) {
            $this->render('user_edit_form', ['user' => $user, 'error' => 'ERREUR : Erreur lors de la modification de l\'utilisateur.', 'errorlog' => $e->getMessage()]);
        }
    }
}