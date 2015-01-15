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
        $utilisateurs = Utilisateur::paginate(20);

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
    
    // public function confirmationSupprimer($id)
    // {
    //     // Set titre page générée
    //     $proprietesPage = array('titre' => 'Utilisateur - Confirmer supression');

    //     $Utilisateur = Utilisateur::findOrFail($id);

    //     // Enboite vue sinistres dans vue design
    //     return 
    //       View::make('faireface', $proprietesPage)
    //         ->nest('contenu',
    //                'utilisateurs.supp-utilisateur',
    //                 array('utilisateur' => $Utilisateur));
    // }

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

    public function inscription()
    {
      // Set titre page générée
      $proprietesPage = array('titre' => 'Utilisateur - Inscription');

      // Variable pour les infos de l'utilisateur
      if (Input::has ('txtNom') && Input::has ('txtUtilisateur') &&
            Input::has ('txtMotPasse') && Input::has ('txtEmail'))
      {
        $nom = Input::get('txtNom');
        $login = Input::get('txtUtilisateur');
        $mdp = Input::get('txtMotPasse');
        $email = Input::get('txtEmail');

        if ($nom != "" && $login !="" && $mdp != "" && $email != "")
        {
          $user = Utilisateur::where('nomUtilisateur',Input::get('txtUtilisateur'))->get();
          if(is_null($user))
          {
            $Utilisateur = new Utilisateur;      

            $Utilisateur->nomUtilisateur = $login;
            $Utilisateur->nom = $nom;
            $Utilisateur->password = Hash::Make($mdp);
            $Utilisateur->email = $email;
            $Utilisateur->niveau = 1;

            $Utilisateur->save();

            return $this->afficherSucces("Bienvenu ". $login. "!");
          }
          else
          {
            return $this->afficherErreur("Nom d'utilisateur déjà utilisé.");
          }
        }
        else
        {
          return $this->afficherErreur("Tous les champs sont obligatoires");         
        }
      }
      else
      {
        return $this->afficherErreur("Il manque des champs");
      }      

      return 
        View::make('faireface', $proprietesPage)
          ->nest('contenu',
                 'succes');
    }
  }
?>