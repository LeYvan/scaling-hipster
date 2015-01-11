<?php

class PagePrincipale extends BaseController {

    /**
     * Affiche la page d'acceuile.
     */
    public function afficherAcceuile()
    {
        return View::make('accueil',array('titre' => "fuck"));
    }
}

?>