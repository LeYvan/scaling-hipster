<?php
class ElementsSinistreController extends BaseController {

    /**
     * Lister les sinistres par catégorie.
     * Lister les sinistres de toutes les catégories si aucune spécifiée.
     */
    public function confirmerSupprimer($id)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Sinistres');


        $element = ElementSinistre::where('id',$id)->firstOrFail();
        $sinistre = Sinistre::findOrFail($element->sinistre_id);

        // Enboite vue sinistres dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'sinistres.supp-element',
                    array('id' => $id,
                          'element' => $element,
                          'sinistre' => $sinistre));
    }

    public function Supprimer()
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Sinistres');

        try {
          $element = ElementSinistre::where('id',Input::get('id'))->firstOrFail();
          $element->delete();
        } catch(Exception $e) {
          return 
            View::make('faireface', $proprietesPage)
              ->nest('contenu',
                     'erreur',
                     array('message' => "L'élément n'existe plus!"));
        }

        // Enboite vue sinistres dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'succes');
    }
}
?>