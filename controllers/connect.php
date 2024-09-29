<?php

use model\UserDAO;

require_once(__ROOT__.'/controllers/Controller.php');

class ConnectUserController extends Controller
{
    /**
     * Renders the main page.
     * 
     * Cette méthode est responsable de l'affichage de la page principale.
     * 
     * @param array $request Les paramètres de la requête HTTP.
     * @return void
     */
    public function get($request): void
    {
        $this->render('main', []);
    }

    /**
     * Handles user authentication based on provided email and password.
     * 
     * Cette méthode gère l'authentification de l'utilisateur en fonction de l'email 
     * et du mot de passe fournis. Si l'authentification réussit, la session est
     * définie et l'utilisateur est redirigé vers le panneau. Sinon, il est redirigé
     * vers la page principale avec un message d'erreur.
     * 
     * @param array $request Les paramètres de la requête HTTP contenant 'email' et 'password'.
     * @return void
     */
    public function post($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userDAO = UserDAO::getInstance();
        $user = $userDAO->find($request['email'], $request['password']);

        if ($user != null) {
            $_SESSION['email'] = $request['email'];
            $_SESSION['password'] = $request['password'];

            $this->render('panel', ['user' => $user]);
        } else {
            $this->render('main', ['error' => 'ERREUR : Email ou mot de passe incorrect']);
        }
    }
}

?>
