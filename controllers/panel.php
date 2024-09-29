<?php

use model\UserDAO;

require_once(__ROOT__.'/controllers/Controller.php');

class PanelController extends Controller
{
    /**
     * Rends la page du panneau si la session utilisateur existe et est valide,
     * sinon affiche un message d'erreur ou la page principale.
     * 
     * Cette méthode vérifie si une session utilisateur est active 
     * et valide. Si oui, elle récupère les informations de l'utilisateur 
     * et rend la vue du panneau. Si la session n'est pas valide, 
     * elle redirige vers la page principale avec un message d'erreur.
     *
     * @param array $request Les paramètres de la requête HTTP. 
     *                       (Actuellement utilisé uniquement pour l'affichage).
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

        // Récupérer l'utilisateur en fonction de l'email et du mot de passe
        $user = UserDAO::getInstance()->find($_SESSION['email'], $_SESSION['password']);

        // Rendre la vue du panneau ou afficher une erreur
        if ($user) {
            $this->render('panel', ['user' => $user]);
        } else {
            $this->render('main', ['error' => 'ERREUR : Email ou mot de passe incorrect.']);
        }
    }
}

?>
