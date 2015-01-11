<?php
class SinistresController extends BaseController {

    /**
     * Gère les sinistres.
     */
    public function lister($categorie_id = 0)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Sinistres');


        if ($categorie_id > 0)
        {
          // Get sinistres de categorie_id
          $sinistres = Sinistre::where('categorie_id',$categorie_id)->paginate(15);
        } 
        else
        {
          // Get sinistres de categorie_id
          $sinistres = Sinistre::paginate(15);
        }


        // Get all categories (pour sidebar)
        $categories = CategorieSinistre::all();

        // Enboite vue sinistres dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'sinistres.afficher-sinistres',
                    array('sinistres' => $sinistres,
                          'categories' => $categories,
                          'categorie_id' => $categorie_id));
      }
}
?>