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
        $Utilisateur = Utilisateur::where('id',$id)->firstOrFail();

        // Enboite vue formulaire dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'utilisateurs.formulaire',
                    array('utilisateur' => $Utilisateur));
    }

    public function profileGet()
    {

    if(!Auth::check()) {
      return $this->afficherSuccesRedirect("/","Vous devez être connecté pour modifier votre profile.");
    }

    $user = Auth::user();

    // Set titre page générée
    $proprietesPage = array('titre' => 'Profile - Modifier');

    // Get utilisateur
    $Utilisateur = Utilisateur::where('id',$user->id)->firstOrFail();

    // Enboite vue formulaire dans vue design
    return 
      View::make('faireface', $proprietesPage)
        ->nest('contenu',
               'utilisateurs.profile',
                array('utilisateur' => $Utilisateur));
    }

    public function profilePost($id)
    {
      if (!(Input::has('nom') &&
          Input::has('email') &&
          Input::has('sms'))){

        return $this->afficherErreur("Introuvable");
      }

      $Utilisateur = Utilisateur::findOrFail($id);

      $Utilisateur->nom = htmlspecialchars(Input::get('nom'));
      $Utilisateur->email = htmlspecialchars(Input::get('email'));
      $Utilisateur->sms = htmlspecialchars(Input::get('sms'));

      $Utilisateur->save();

      return $this->afficherSucces("Profile enregistré!");
    }

    public function modifierPost($id)
    {
            // Set titre page générée
      $proprietesPage = array('titre' => 'Utilisateur - Modifier');

      if (!(Input::has('nom') &&
          Input::has('email') &&
          Input::has('sms') &&
          Input::has('niveau'))){

        return $this->afficherErreur("Introuvable");
      }

      $Utilisateur = Utilisateur::findOrFail($id);

      $Utilisateur->nom = htmlspecialchars(Input::get('nom'));
      $Utilisateur->email = htmlspecialchars(Input::get('email'));
      $Utilisateur->sms = htmlspecialchars(Input::get('sms'));
      $Utilisateur->niveau = htmlspecialchars(Input::get('niveau'));

      $Utilisateur->save();

      return $this->afficherSucces("Modifications enregistrées!");
    }

    public function supprimer()
    {
      // Set titre page générée
      $proprietesPage = array('titre' => Input::get("id") . 'Utilisateur - Suppression');

      try {
        $Utilisateur = Utilisateur::findOrFail(Input::get("id"));
        $nom = $Utilisateur->nom;

        $message = '<p>Supression de ' . $nom . ' réussi.</p>';

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

          if(!is_null($user))
          {
            $Utilisateur = new Utilisateur;      

            $Utilisateur->nomUtilisateur = $login;
            $Utilisateur->nom = $nom;
            $Utilisateur->password = Hash::Make($mdp);
            $Utilisateur->email = $email;
            $Utilisateur->niveau = 1;

            try
            {
              $Utilisateur->save();
              return $this->afficherSucces("Bienvenue ". $login. "!</br>Utilisez maintenant le menu connexion en haut à droite.");
            }
            catch (Exception $e)
            {
              return $this->afficherErreur("Nom d'utilisateur déjà utilisé.");
            }
            
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
    public function connexion()
    {
      $reussi = Auth::attempt(array('nomUtilisateur' => Input::get("nomUtilisateur"), 'password' => Input::get("motPasse")));
      if ($reussi)
      {
        // $params = array("reussi" => true, "message" => 'Connexion réussie!');
        return $this->afficherSucces('Connexion réussie');
      } else {
        // $params = array("reussi" => false, "message" => 'La connexion a échouée!');    
        return $this->afficherErreur('La connexion a échouée!');
      }
    }
    public function deconnexion(){
      Auth::logout();

      return Redirect::to('/')->with('evenement', $params = array('message' => 'Déconnecté!', 'reussi' => true));
    }
  }
?>
