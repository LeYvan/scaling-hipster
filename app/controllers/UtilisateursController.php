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
    public function modifierGet($id)
    {
      // Set titre page générée
        $proprietesPage = array('titre' => 'Utilisateur - Modifier');

        // Get utilisateur
        $Utilisateur = utilisateur::where('id',$id)->firstOrFail();

        // Enboite vue formulaire dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'utilisateurs.formulaire',
                    array('utilisateur' => $Utilisateur));
    }

    public function modifierPost($id)
    {
            // Set titre page générée
      $proprietesPage = array('titre' => 'Utilisateur - Modifier');

      if (!(Input::has('nom') &&
          Input::has('email') &&
          Input::has('niveau'))){

        return $this->afficherErreur("Introuvable");
      }

      $Utilisateur = Utilisateur::findOrFail($id);

      $Utilisateur->nom = Input::get('nom');
      $Utilisateur->email = Input::get('email');
      $Utilisateur->niveau = Input::get('niveau');

      $Utilisateur->save();

      return 
        View::make('faireface', $proprietesPage)
          ->nest('contenu',
                 'succes');
    }
    
    public function confirmationSupprimer($id)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Utilisateur - Confirmer supression');

        $Utilisateur = Utilisateur::findOrFail($id);

        // Enboite vue sinistres dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'utilisateurs.supp-utilisateur',
                    array('utilisateur' => $Utilisateur));
    }

    public function supprimer()
    {
      // Set titre page générée
      $proprietesPage = array('titre' => 'Utilisateur - Suppression');

      try {
        $Utilisateur = Utilisateur::findOrFail(Input::get("id"));
        $nom = $Utilisateur->nom;

        $message = '<p>Supression de ' . $nom . ' réussi.</p>';
        $message = $message . "<a href=\"/utilisateurs/\">Retour à la liste des utilisateurs.</a>";

        $Utilisateur->delete($message);

        return $this->afficherSucces($message);
      } catch (Exception $e) {
        return $this->afficherErreur("Utilisateur introuvable.");
      }

    }
  }
?>