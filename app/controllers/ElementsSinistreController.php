<?php
class ElementsSinistreController extends BaseController {

    /**d-
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

    public function supprimer()
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Sinistres');

        try {
          $element = ElementSinistre::where('id',Input::get('id'))->firstOrFail();

          $message = 'Suppression de "' . $element->fichier . "' réussie!";

          $element->delete();

          return $this->afficherSucces($message);
        } catch(Exception $e) {
          return $this->afficherErreur('Element introuvable.');
        }
    }
}
?>