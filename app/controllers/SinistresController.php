<?php
class SinistresController extends BaseController {

    /**
     * Lister les sinistres par catégorie.
     * Lister les sinistres de toutes les catégories si aucune spécifiée.
     */
    public function lister($etiquette = null)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Sinistres');

        $catCourante = null;
        if ($etiquette)
        {
          $catCourante = CategorieSinistre::where('etiquette',$etiquette)->first();
          // var_dump($catCourante);
          // Get sinistres de categorie_id
          $sinistres = Sinistre::where('categorie_id',$catCourante->id)->orderBy('created_at', 'desc')->paginate(10);
        }
        else
        {
          $sinistres = Sinistre::orderBy('created_at', 'desc')->paginate(10);
        }

        // Get all categories (pour sidebar)
        $lstCategories = CategorieSinistre::lists('etiquette', 'id');
        $categories = CategorieSinistre::all();

        $ressources = array ();
        foreach($categories as $categorie)
        {
          $ressources[$categorie->id] = Ressource::where('categorie_id',$categorie->id)->get();
        }

        // Enboite vue sinistres dans vue design
        return
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'sinistres.lister',
                    array('sinistres' => $sinistres,
                          'lstCategories' => $lstCategories,
                          'categories' => $categories,
                          'catCourante' => $catCourante,
                          'ressources' => $ressources));
    }

    public function ajouterGet()
    {
        // Set titre page générée
        $proprietesPage = array('titre' => '(GET) Ajouter un sinistre');

        // Get all categories
        $categories = CategorieSinistre::lists('etiquette','id');
        return
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'sinistres.ajouter',
                    array('mode' => "ajout",
                          'categories' => $categories));
    }


    public function ajouterPost()
    {
        $valide = true;
        $message = '';

      // Set titre page générée
      $proprietesPage = array('titre' => Input::get('id'));
      // var_dump(Input::file('files'));
      if (!(Input::has('titre') &&
          Input::has('rapport') &&
          Input::has('categorie_id'))){

        return $this->afficherErreurWithInput("Données de sinistre invalide pour insertion.");
      }

      if (!Auth::check()) {
        return $this->afficherErreurWithInput("Vous devez être connecté pour reporter un sinistre.");
      }

      try
      {

        $sinistre = new Sinistre;

        $sinistre->titre = htmlspecialchars(Input::get('titre'));
        $sinistre->rapport = htmlspecialchars (Input::get('rapport'));
        $sinistre->categorie_id = Input::get('categorie_id');
        $sinistre['geo-x'] = Input::get('geo-x');
        $sinistre['geo-y'] = Input::get('geo-y');
        $sinistre->utilisateur_id = Auth::user()->id;

        $sinistre->save();

        $fichiers = Input::file('files');
        foreach($fichiers as $fichier)
        {
          if (is_null($fichier) || !$fichier->isValid()) break;

          $ext = substr($fichier->getMimeType(),strpos($fichier->getMimeType(),"/")+1);

          $dossierLocal = md5($sinistre->titre);
          $fichierLocal = md5($fichier->getClientOriginalName()) . '.' . $ext;

          $element = new ElementSinistre;
          $element->fichier = $fichierLocal;
          $element->type = '';
          $element->sinistre_id = $sinistre->id;

          switch($fichier->getMimeType())
          {
            case "image/jpeg":
            case "image/png":
              $element->type = 'image';
              $valide = true;
              break;
            case "video/mp4":
              $element->type = 'video';
              $valide = true;
              break;
            default:
              $valide = false;
              break;
          }

          if (!$valide) {
            $message = $message . "Le fichier '" . $fichier->getClientOriginalName() . "' est invalide.<br/>";
            throw new Exception();
            break;
          } else {
            $url = $dossierLocal . '/' . $fichierLocal;
            $fichier->move(public_path() . '/uploads/' . $dossierLocal . '/', $fichierLocal);
            $element->fichier = $url;
            $element->save();
          }
        }
        return $this->afficherSucces('Votre rapport de sinistre a bien été envoyé.');
      } catch (Exception $e) {
        try {
          $sinistre->delete();
        } catch (Exception $w) {
          $message = $message . 'De plus, une erreure est survenue lors de la gestion d\'erreur: ' . $w->getMessage();
        }
        return $this->afficherErreurWithInput('Le sinistre n\'a pu être reporté: </br>' . $message);
      }
    }

    public function modifierGet($id)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => '(GET) Modifier un sinistre');

        // Get sinistres de categorie_id
        $sinistre = Sinistre::where('id',$id)->firstOrFail();

        // Get all categories
        $categories = CategorieSinistre::lists('etiquette','id');


        // Enboite vue sinistres dans vue design
        return
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'sinistres.modifier',
                    array('sinistre' => $sinistre,
                          'categories' => $categories));
    }

    public function modifierPost($id)
    {

      // Set titre page générée
      $proprietesPage = array('titre' => 'Sinistre - Modifier');

      if (!(Input::has('titre') &&
          Input::has('rapport') &&
          Input::has('categorie_id'))){

        return $this->afficherErreur("Tout les champs sont obligatoires!");
      }

      $sinistre = Sinistre::findOrFail($id);

      $sinistre->titre = htmlspecialchars(Input::get('titre'));
      $sinistre->rapport = htmlspecialchars(Input::get('rapport'));
      $sinistre->categorie_id = Input::get('categorie_id');

      $sinistre->save();

      $message = "Modification enregistrées.";
      return $this->afficherSucces($message);
    }

    public function supprimer()
    {
      // Set titre page générée
      $proprietesPage = array('titre' => 'Sinistre - Suppression');

      try {
        $sinistre = Sinistre::findOrFail(Input::get("id"));
        $titre = $sinistre->titre;

        $message = '<p>Supression de "' . $titre . '" réussi.</p>';

        $sinistre->delete($message);

        return $this->afficherSucces($message);
      } catch (Exception $e) {
        return $this->afficherErreur("Sinistre introuvable. (" . var_dump(Input::get()) . ")");
      }
    }
}
?>
