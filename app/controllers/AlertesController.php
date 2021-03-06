<?php
class AlertesController extends BaseController {

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


        $ressources = array ();
        foreach($categories as $categorie)
        {
          $ressources[$categorie->id] = Ressource::where('categorie_id',$categorie->id)->get();
        }

        // Enboite vue sinistres dans vue design
        return
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'alertes.lister',
                    array('alertes' => $alertes,
                          'lstCategories' => $lstCategories,
                          'categories' => $categories,
                          'catCourante' => $catCourante,
                          'ressources' => $ressources));
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

    private function validerPublier()
    {
      if (empty($contenu)) return "Le contenu est obligatoire!";
      if (empty($lat)) return "La latitude est obligatoire!";
      if (empty($long)) return "La longitude est obligatoire!";
      if (empty($categorie_id)) return "La catégorie est obligatoire!";

      return "Données invalide (erreure générale)";
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
            return $this->afficherErreurWithInput($this->validerPublier());
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
            $message = "Erreur interne: " . $e->getMessage();
        }

        if (!$erreur) {
            return $this->afficherSuccesRedirect('/alertes/','Alerte enregistrée (pas diffusée, il peut y avoir un délais).');
        } else {
            return $this->afficherErreurWithInput($message);
        }


    }

    public function details($id)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Alerte - Détails');

        // Get utilisateur
        $alerte = Alerte::where('id',$id)->firstOrFail();

        // Enboite vue formulaire dans vue design
        return
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'alertes.details',
                    array('alerte' => $alerte));
    }
}
?>
