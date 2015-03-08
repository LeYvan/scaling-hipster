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
}
?>
