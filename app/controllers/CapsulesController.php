<?php
class CapsulesController extends BaseController {

    public function lister($etiquette = null)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Nouvelles');
        $proprietesPage['contenu'] = '';

        $capsules = Capsule::orderBy('created_at', 'desc')->get();

        foreach ($capsules as $capsule)
        {
            $proprietesPage['contenu'] = $proprietesPage['contenu'] . '</br><div class="well"><b>@<i>' . $capsule->utilisateur()->nom . '</i></b>: ' . $capsule->titre . "</div>";
        }

        return 
        View::make('faireface', $proprietesPage);
    }

    public function ajouterGet()
    {
      return "CapsulesController@ajouterGet";
    }

    public function ajouterPost()
    {
        return $this->afficherSucces('CapsulesController@ajouterPost');
    }

    public function modGet($id)
    {
      return "CapsulesController@modifierGet";
    }

    public function modPost($id)
    {
        return $this->afficherSucces('CapsulesController@modPost');
    }

    public function supprimer()
    {
        return $this->afficherSucces('CapsulesController@supprimer');
    }
}
?>