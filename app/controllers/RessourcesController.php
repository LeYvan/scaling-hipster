<?php
class RessourcesController extends BaseController {

    public function lister($etiquette = null)
    {
        $catCourante = null;
        $ressources = null;

        // Set titre page générée
        $proprietesPage = array('titre' => 'Ressources d\'urgence');

        if ($etiquette)
        {
            $catCourante = CategorieSinistre::where('etiquette',$etiquette)->first();
            $ressources = Ressource::where('categorie_id',$catCourante->id)
                ->orderBy('created_at', 'desc')->paginate(10);
        }
        else
        {
            $ressources = Ressource::orderBy('created_at', 'desc')->paginate(10);
        }

        $lstCategories = CategorieSinistre::lists('etiquette', 'id');
        $categories = CategorieSinistre::all();

        return
            View::make('faireface', $proprietesPage)
            ->nest ('contenu',
                    'ressources.lister',
                    array('ressources' => $ressources,
                          'lstCategories' => $lstCategories,
                          'categories' => $categories,
                          'catCourante' => $catCourante));
    }
    public function supprimer()
    {
              // Set titre page générée
      $proprietesPage = array('titre' => 'Ressource - Suppression');

      try {
        $ressource = Ressource::findOrFail(Input::get("id"));
        $nom = $ressource->nom;

        $message = '<p>Supression de "' . $nom . '" réussie.</p>';

        $ressource->delete($message);

        return $this->afficherSucces($message);
      } catch (Exception $e) {
        return $this->afficherErreur("Ressource introuvable. (" . var_dump(Input::get()) . ")");
      }
    }

    public function AjouterGet()
    {
      // Set titre page générée
      $proprietesPage = array('titre' => 'Ressource - Ajout');
      // Get all categories
      $categories = CategorieSinistre::all();

      // Mettre la vue...
      return
          View::make('faireface', $proprietesPage)
          ->nest ('contenu',
                  'ressources.formulaire',
                  array('categories' => $categories));
    }

    public function ajouterPost()
    {
        $erreur = false;
        $message = "";

        $nom = htmlspecialchars(Input::get('nom'));
        $telephone =  htmlspecialchars(Input::get('telephone'));
        $email = htmlspecialchars(Input::get('email'));
        $url = htmlspecialchars(Input::get('url'));
        $description = htmlspecialchars(Input::get('description'));
        $categorie_id = htmlspecialchars(Input::get('categorie_id'));

        if (empty($nom) ||
            empty($telephone) ||
            empty($email) ||
            empty($url) ||
            empty($description) ||
            empty($categorie_id))
        {
            $erreur = true;
            $message = "Données invalides";
            return $this->afficherErreurWithInput($message);
        }

        try {
            $ressource = new Ressource;

            $ressource->nom = $nom;
            $ressource->telephone = $telephone;
            $ressource->email = $email;
            $ressource->url = $url;
            $ressource->description = $description;
            $ressource->categorie_id = $categorie_id;

            $ressource->save();
        } catch(Exception $e) {
            $erreur = true;
            $message = "Erreur interne: " . $e->getMessage();
        }

        if (!$erreur) {
            return $this->afficherSuccesRedirect('/ressources/','Ressource enregistrée.');
        } else {
            return $this->afficherErreurWithInput($message);
        }
    }

    public function ModifierGet($id)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Ressources - Modifier');

        // Allez chercher la nouvelle avec le id transmit
        $ressource = Ressource::where('id',$id)->firstOrFail();

        $categories = CategorieSinistre::all();

        // Emboiter la vue
        return
            View::make('faireface', $proprietesPage)
            ->nest ('contenu',
                    'ressources.formulaire',
                    array('ressource' => $ressource,
                          'categories' => $categories));
    }

    public function ModifierPost($id)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Ressource - Modifier');

        $nom = htmlspecialchars(Input::get('nom'));
        $telephone =  htmlspecialchars(Input::get('telephone'));
        $email = htmlspecialchars(Input::get('email'));
        $url = htmlspecialchars(Input::get('url'));
        $description = htmlspecialchars(Input::get('description'));
        $categorie_id = htmlspecialchars(Input::get('categorie_id'));

        if (empty($nom) ||
            empty($telephone) ||
            empty($email) ||
            empty($url) ||
            empty($description) ||
            empty($categorie_id))
        {
            $erreur = true;
            $message = "Données invalides";
            return $this->afficherErreurWithInput($message);
        }


        try
        {

                  $ressource = Ressource::findOrFail($id);

                  $ressource->nom = $nom;
                  $ressource->telephone = $telephone;
                  $ressource->email = $email;
                  $ressource->url = $url;
                  $ressource->description = $description;
                  $ressource->categorie_id = $categorie_id;

          $ressource->save();
          return Redirect::to('/ressources/')->with('evenement', $params = array('message' => 'Modification réussie', 'reussi' => true));
        }
        catch (Exception $e)
        {
          return $this->afficherErreur("Erreur lors de l'insertion!");
        }
    }
}
?>
