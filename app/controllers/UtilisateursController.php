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

    private function validateProfile($checkSms)
    {
      if (Input::has('nom') &&
          strlen(Input::get('nom')) > 0)
      {
        if (Input::has('email') &&
            strlen(Input::get('email')) > 0)
        {
          $regex = '/^[0-9()-]+$/';
          $match = preg_match($regex, Input::get('sms'), $matches, PREG_OFFSET_CAPTURE);

          if (Input::has('sms') &&
              $match == 1)
          {
            return true;
          }
          else
          {
            if ($checkSms)
            {
              return false;
            }
            else
            {
              if (Input::has('sms') &&
                  $match == false)
              {
                return "Le numéro de tléphone doit contenir des chiffres et des '-' uniquement";
              }
              else
              {
                return true;
              }

            }
          }
        }
        else
        {
          return "Le email doit contenir un '@' et un '.'";
        }
      }
      else
      {
        return "Le nom est requis.";
      }

      return false;
    }

    private function checkNieau()
    {
      return Input::has('niveau') && strlen(Input::get('niveau')) > 0;
    }

    public function profilePost($id)
    {
      if ($this->validateProfile(false) !== true)
      {
        return $this->afficherErreur($this->validateProfile(false));
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

      if ($this->validateProfile(false) !== true)
      {
        return $this->afficherErreur($this->validateProfile(false));
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

    public function unsubscribeSms()
    {
      if (!Auth::check())
      {
        return $this->afficherErreurWithInput("Vous devez être connecté!");
      }

      try {
        $user = Auth::user();

        $user->sms = "";
        $user->save();

        return $this->afficherSucces("Vous êtes désabonné. Entrez votre numéro à nouveau pour recevoir les alertes.");

      } catch (Exception $e) {
        return $this->afficherErreurWithInput("Vous ne pouvez pas vous désabonné et êtes maudit.");
      }
    }
  }
?>
