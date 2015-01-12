<?php
class UtilisateursController extends BaseController {

    /**
     * Lister les utilisateurs.
     */
    public function lister()
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Utilisateurs');

        // Get all utilisateurs (pour sidebar)
        $utilisateurs = Utilisateur::paginate(15);

        // Enboite vue sinistres dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'utilisateurs.lister',
                    array('utilisateurs' => $utilisateurs));
    }

  }
?>