<?php
require_once(__ROOT__.'/controllers/Controller.php');

class DisconnectUserController extends Controller
{
    /**
     * Gère la déconnexion de l'utilisateur. 
     * Si l'utilisateur n'est pas actuellement connecté,
     * il est redirigé vers la page principale avec un message d'erreur.
     * Sinon, la session est terminée et l'utilisateur est redirigé vers la page de déconnexion.
     * 
     * @param array $request Les paramètres de la requête HTTP.
     * @return void
     */
    public function get($request): void
    {
        // Démarre la session si elle n'est pas déjà démarrée
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
            $this->render('main', ['error' => 'ERREUR : Pas de session ouverte.']);
            return;
        }

        session_destroy();
        $this->render('user_disconnect', []);
    }
}