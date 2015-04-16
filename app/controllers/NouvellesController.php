<?php
class NouvellesController extends BaseController {

    public function lister()
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Nouvelles');

        // Allez chercher toutes les nouvelles
        $nouvelles = Nouvelle::orderBy('created_at', 'desc')->paginate(10);

        // Enboite vue nouvelles dans vue design
        return
            View::make('faireface', $proprietesPage)
            ->nest ('contenu',
                    'nouvelles.lister',
                    array('nouvelles' => $nouvelles));

    }

    public function ajouterGet()
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Nouvelles - Ajout');

        // Mettre la vue...
        return
            View::make('faireface', $proprietesPage)
            ->nest ('contenu',
                    'nouvelles.nouveau');
    }

    public function ajouterPost()
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Nouvelles - Ajout');

        // Vérifier la présence des différents champs transmis par le formulaire
        if (Input::has('titre') && Input::has('contenu'))
        {
            $titre = Input::get('titre');
            $contenu = Input::get('contenu');

            if($titre != "" && $contenu != "")
            {
                $nouvelle = new Nouvelle;

                $nouvelle->titre = $titre;
                $nouvelle->contenu = $contenu;
                $nouvelle->utilisateur_id = Auth::user()->id;

                try
                {
                  $nouvelle->save();
                  return Redirect::to('/nouvelles/')->with('evenement', $params = array('message' => 'Insertion réussie', 'reussi' => true));
                }
                catch (Exception $e)
                {
                  return $this->afficherErreur("Erreur lors de l'insertion!");
                }
            }
            else
            {
                return $this->afficherErreur("Tous les champs sont obligatoires");
            }
        }
        else
        {
          return $this->afficherErreur("Des champs sont manquants");
        }
    }

    public function modGet($id)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Nouvelles - Modifier');

        // Allez chercher la nouvelle avec le id transmit
        $nouvelle = Nouvelle::where('id',$id)->firstOrFail();

        // Emboiter la vue
        return
            View::make('faireface', $proprietesPage)
            ->nest ('contenu',
                    'nouvelles.nouveau',
                    array('nouvelle' => $nouvelle));
    }

    public function modPost($id)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Nouvelles - Modifier');

        // Vérifier la présence des différents champs transmis par le formulaire
        if (!(Input::has('titre') && Input::has('contenu')))
        {
            return $this->afficherErreur("Il y a des champs manquants");
        }

        // Allez chercher la nouvelle avec le id transmit
        $nouvelle = Nouvelle::findOrFail($id);

        // Modifier les champs de la bd avec les nouvelles valeurs
        $nouvelle->titre = htmlspecialchars(Input::get('titre'));
        $nouvelle->contenu = htmlspecialchars(Input::get('contenu'));

        // Enregistrer la nouvelle
        try
        {
          $nouvelle->save();
          return Redirect::to('/nouvelles/')->with('evenement', $params = array('message' => 'Modification réussie', 'reussi' => true));
        }
        catch (Exception $e)
        {
          return $this->afficherErreur("Erreur lors de l'insertion!");
        }
    }

    public function suppPost()
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Nouvelles - Supprimer');

        try
        {
            // Allez chercher la nouvelles avec le id transmit
            $nouvelle = Nouvelle::findOrFail(Input::get("id"));

            // Allez chercher le nom de l'utilisateur et le titre de la nouvelle
            $nom = $nouvelle->utilisateur()->nom;
            $titre = $nouvelle->titre;

            // Message de confirmation
            $message = '<p>Supression de :'. $titre .' publiée par :' . $nom . ' réussie.</p>';

            // Effacer la nouvelle et afficher la page succès.
            $nouvelle->delete($message);
            return $this->afficherSucces($message);
        }
        catch (Exception $e)
        {
            // Afficher la page erreur.
            return $this->afficherErreur("Nouvelle introuvable.");
        }
    }
}
?>
