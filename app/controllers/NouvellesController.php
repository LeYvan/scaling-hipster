<?php
class NouvellesController extends BaseController {

    public function lister($etiquette = null)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Nouvelles');
        $proprietesPage['contenu'] = '';

        $nouvelles = Nouvelle::orderBy('created_at', 'desc')->get();

        foreach ($nouvelles as $nouvelle)
        {
            $proprietesPage['contenu'] = $proprietesPage['contenu'] . '</br><div class="well"><b>@<i>' . $nouvelle->utilisateur()->nom . '</i></b>: ' . $nouvelle->titre . "</div>";
        }

        return 
        View::make('faireface', $proprietesPage);
    }

    public function ajouterGet()
    {
      return "NouvellesController@ajouterGet";
    }

    public function ajouterPost()
    {
        return $this->afficherSucces('NouvellesController@ajouterPost');
    }

    public function modGet($id)
    {
      return "NouvellesController@modifierGet";
    }

    public function modPost($id)
    {
        return $this->afficherSucces('NouvellesController@modPost');
    }

    public function supprimer()
    {
        return $this->afficherSucces('NouvellesController@supprimer');
    }
}
?>