<?php
class AlertesController extends BaseController {

    public function lister($etiquette = null)
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
        return $this->afficherSuccesRedirect('/alertes/','AlertesController@ajouterPost');
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