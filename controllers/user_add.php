<?php

use model\User;
use model\UserDAO;

require_once(__ROOT__ . '/controllers/Controller.php');
require_once(__ROOT__ . '/model/User.php');
require_once(__ROOT__ . '/model/UserDAO.php');

class AddUserController extends Controller
{
    /**
     * Rends le formulaire d'ajout d'utilisateur.
     * 
     * Cette méthode est appelée lors d'une requête GET. Elle affiche 
     * le formulaire permettant à l'administrateur ou à l'utilisateur 
     * de créer un nouveau compte utilisateur.
     *
     * @param array $request Les paramètres de la requête HTTP.
     * @return void
     */
    public function get($request) {
        $this->render('user_add_form', []);
    }

    /**
     * Traite la requête POST du formulaire d'ajout d'utilisateur.
     * 
     * Cette méthode valide la longueur du mot de passe, initialise 
     * un nouvel utilisateur, et tente d'insérer l'utilisateur dans 
     * la base de données. Si l'insertion est réussie, l'utilisateur 
     * est redirigé vers une page de validation; sinon, un message 
     * d'erreur est affiché.
     *
     * @param array $request Les paramètres de la requête HTTP, 
     * incluant l'email, le mot de passe, et d'autres détails de 
     * l'utilisateur.
     * @return void
     */
    public function post($request): void
    {
        // Vérifier la longueur du mot de passe
        if (strlen($request['password']) < 8) {
            $this->render('user_add_form', ['error' => 'Veuillez utiliser un mot de passe de 8 character minimum.']);
            return;
        }

        // Initialiser un nouvel utilisateur
        $user = new User();
        $user->init($request['email'], $request['password'], $request['firstname'], $request['lastname'], $request['birthdate'], $request['gender'], $request['height'], $request['weight']);
        $userDAO = UserDAO::getInstance();

        try {
            // Essayer d'insérer l'utilisateur dans la base de données
            $userDAO->insert($user);
        } catch (Exception $e) {
            // Gérer les erreurs lors de l'enregistrement
            $this->render('user_add_form', ['error' => 'ERREUR : Erreur lors de l\'enregistrement de l\'utilisateur.', 'errorlog' => $e->getMessage()]);
            return;
        }

        // Rendre la page de validation si l'ajout est réussi
        $this->render('user_add_valid', ['firstname' => $request['firstname'], 'lastname' => $request['lastname']]);
    }
}
