<?php
require_once(__ROOT__.'/controllers/Controller.php');

class AProposController extends Controller
{
    /**
     * Renders the "apropos" page.
     * 
     * Cette méthode est responsable de l'affichage de la page "À propos".
     * 
     * @param array $request Les paramètres de la requête HTTP.
     * @return void
     */
    public function get($request): void
    {
        $this->render('apropos',[]);
    }
}