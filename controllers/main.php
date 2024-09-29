<?php
require_once(__ROOT__.'/controllers/Controller.php');

class MainController extends Controller
{
    /**
     * Rend la page principale.
     * 
     * Cette méthode est responsable de l'affichage de la page principale 
     * de l'application. Elle ne prend pas de paramètres spécifiques 
     * à la vue à afficher.
     *
     * @param array $request Les paramètres de la requête HTTP. 
     *                      (Actuellement non utilisés dans cette méthode).
     * @return void
     */
    public function get($request): void
    {
        $this->render('main',[]);
    }
}

?>
