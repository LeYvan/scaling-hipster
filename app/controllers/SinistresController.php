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

        // Enboite vue sinistres dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'sinistres.lister',
                    array('sinistres' => $sinistres,
                          'lstCategories' => $lstCategories,
                          'categories' => $categories,
                          'catCourante' => $catCourante));
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
      // Set titre page générée
      $proprietesPage = array('titre' => Input::get('id'));
      // var_dump(Input::file('files'));
      if (!(Input::has('titre') &&
          Input::has('rapport') &&
          Input::has('categorie_id'))){

        return $this->afficherErreur("Données de sinistre invalide pour insertion.");
      }

      if (!Auth::check()) {
        return $this->afficherErreurWithInput("Vous devez être connecté pour reporter un sinistre.");
      }

      $sinistre = new Sinistre;

      $sinistre->titre = Input::get('titre');
      $sinistre->rapport = Input::get('rapport');
      $sinistre->categorie_id = Input::get('categorie_id');
      $sinistre['geo-x'] = Input::get('geo-x');
      $sinistre['geo-y'] = Input::get('geo-y');
      $sinistre->utilisateur_id = Auth::user()->id;

      $sinistre->save();

      return $this->afficherSucces('Votre rapport de sinistre a bien été envoyé.');
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

        return $this->afficherErreur("Introuvable");
      }

      $sinistre = Sinistre::findOrFail($id);

      $sinistre->titre = Input::get('titre');
      $sinistre->rapport = Input::get('rapport');
      $sinistre->categorie_id = Input::get('categorie_id');

      $sinistre->save();

      return 
        View::make('faireface', $proprietesPage)
          ->nest('contenu',
                 'succes');
    }

    public function confirmerSupprimer($id)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Sinistres - Suppression');

        $sinistre = Sinistre::where('id',$id)->firstOrFail();

        // Enboite vue sinistres dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'sinistres.supp-sinistre',
                    array('id' => $id,
                          'sinistre' => $sinistre));
    }

    public function supprimer()
    {
        // Set titre page générée
        $proprietesPage = array('titre' => Input::get('id'));

        try {
          $sinistre = Sinistre::where('id',Input::get('id'))->firstOrFail();

          $message = '<p>Supression du sinistre ' . $sinistre->titre . ' réussi.</p>';
          $message = $message . "<a href=\"/sinistres/\">Retour à la liste des sinistres.</a>";

          $sinistre->delete();
          return $this->afficherSucces($message);

        } catch(Exception $e) {
          return 
            View::make('faireface', $proprietesPage)
              ->nest('contenu',
                     'erreur',
                     array('message' => "L'élément n'existe plus!"));
        }
    }
}
?>