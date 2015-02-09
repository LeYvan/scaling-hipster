<?php
class AlertesController extends BaseController {

    public function lister1($etiquette = null)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Alertes');
        $proprietesPage['contenu'] = '';

        $catCourante = null;
        if (!empty($etiquette))
        {
          $catCourante = CategorieSinistre::where('etiquette',$etiquette)->first();
          $alertes = Alerte::where('categorie_id',$catCourante->id)->orderBy('created_at', 'desc')->get();
        }
        else
        {
          $alertes = Alerte::orderBy('created_at', 'desc')->get();
        }

        $lstCategories = CategorieSinistre::lists('etiquette', 'id');
        $categories = CategorieSinistre::all();
        
        foreach ($alertes as $alerte)
        {
          $proprietesPage['contenu'] = $proprietesPage['contenu'] . '</br><div class="well"><b>@<i>' . $alerte->utilisateur()->nom . '</i></b>: ' . $alerte->contenu . "</div>";
        }
        
        return 
          View::make('faireface', $proprietesPage);
    }

    public function lister($etiquette = null)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Alertes');

        setlocale(LC_ALL, 'fr_CA');

        $catCourante = null;
        if ($etiquette)
        {
            $catCourante = CategorieSinistre::where('etiquette',$etiquette)->first();
            $alertes = Alerte::where('categorie_id',$catCourante->id)
                                ->select(DB::raw('FLOOR(created_at / 86400) AS date'))
                                ->groupBy(DB::raw('FLOOR(created_at / 86400) AS date'))
                                ->orderBy('created_at', 'desc')->paginate(10);
        } 
        else
        {
            //$alertes = Alerte::orderBy('created_at', 'desc')->paginate(10);
            $alertes = Alerte::where('categorie_id','>',0)
                                ->orderBy('created_at', 'desc')->paginate(10);
        }

        // Get all categories (pour sidebar)
        $lstCategories = CategorieSinistre::lists('etiquette', 'id');
        $categories = CategorieSinistre::all();

        // Enboite vue sinistres dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'alertes.lister',
                    array('alertes' => $alertes,
                          'lstCategories' => $lstCategories,
                          'categories' => $categories,
                          'catCourante' => $catCourante));
    }

    public function publierGet()
    {
        $proprietesPage = array('titre' => 'Alertes');
        $categories = CategorieSinistre::all();

        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'alertes.publier',
                    array('categories' => $categories));
    }

    public function publierPost()
    {
        $erreur = false;
        $message = "";

        $contenu = htmlspecialchars(Input::get('contenu'));
        $lat =  htmlspecialchars(Input::get('lat'));
        $long = htmlspecialchars(Input::get('long'));
        $categorie_id = htmlspecialchars(Input::get('categorie_id'));

        if (empty($contenu) ||
            empty($lat) ||
            empty($long) ||
            empty($categorie_id))
        {
            $erreur = true;
            $message = "Données invalides";
            return $this->afficherErreurWithInput($message);
        }

        try {
            $alerte = new Alerte;

            $alerte->contenu = $contenu;
            $alerte->lat = $lat;
            $alerte->long = $long;
            $alerte->categorie_id = $categorie_id;
            $alerte->utilisateur_id = Auth::user()->id;

            $alerte->save();
        } catch(Exception $e) {
            $erreur = true;
            $message = "Erreur interne.";
        }

        if (!$erreur) {
            return $this->afficherSuccesRedirect('/alertes/','Alerte enregistrée (pas diffusée).');
        } else {
            return $this->afficherErreurWithInput($message);
        }

        
    }

    public function modGet($id)
    {
      return "AlertesController@modifierGet";
    }

    public function modPost($id)
    {
        return $this->afficherSucces('AlertesController@modPost');
    }

    public function supprimer()
    {
        return $this->afficherSucces('AlertesController@supprimer');
    }
}
?>