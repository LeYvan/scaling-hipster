<?php
class CapsulesController extends BaseController {

    public function lister($etiquette = null)
    {
        $catCourante = null;
        // Set titre page générée
        $proprietesPage = array('titre' => 'Capsules');
        $proprietesPage['contenu'] = '';

        if ($etiquette)
        {
            $capsules = Capsule::where('categorie_id',$etiquette)->orderBy('created_at', 'desc')->get();
        }
        else
        {
            $capsules = Capsule::orderBy('created_at', 'desc')->get();
        }
        return 
            View::make('faireface', $proprietesPage)            
            ->nest ('contenu',
                    'capsules.lister',
                    array('capsules' => $capsules));
    }

    public function ajouterGet()
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Capsule - Ajout');
        // Get all categories
        $categories = CategorieSinistre::lists('etiquette','id');

        // Mettre la vue... 
        return 
            View::make('faireface', $proprietesPage)
            ->nest ('contenu',
                    'capsules.nouveau',
                    array('categories' => $categories));  
    }

    public function ajouterPost()
    {

        $valide = true;
        $message = '';

        if (!(Input::has('titre') && Input::has('contenu') && Input::has('categorie_id'))) 
        {
            return $this->afficherErreurWithInput("Données de la capules invalide pour insertion.");
        }

        if (!Auth::check()) 
        {
            return $this->afficherErreurWithInput("Vous devez être connecté pour crée une capsule.");
        }

        try
        {
            $capsule = new Capsule;
            $capsule->titre = htmlspecialchars(Input::get('titre'));
            $capsule->contenu = htmlspecialchars (Input::get('contenu'));
            $capsule->categorie_id = Input::get('categorie_id');
            $capsule->utilisateur_id = Auth::user()->id;
            try
                {
                  $capsule->save();
                  return Redirect::to('/capsule/')->with('evenement', $params = array('message' => 'Insertion réussie', 'reussi' => true));
                }
                catch (Exception $e)
                {
                  return $this->afficherErreur("Erreur lors de l'insertion!");
                }
                } catch (Exception $e) {
                try {
                    $capsule->delete();
                } catch (Exception $w) {
                    $message = $message . 'De plus, une erreure est survenue lors de la gestion d\'erreur: ' . $w->getMessage();
                }
        }
    }

    public function modGet($id)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Capsule - Modifier');
        // Get all categories
        $categories = CategorieSinistre::lists('etiquette','id');

        $capsule = Capsule::where('id',$id)->firstOrFail();

        // Mettre la vue... 
        return 
            View::make('faireface', $proprietesPage)
            ->nest ('contenu',
                    'capsules.nouveau',
                    array('categories' => $categories,
                          'capsule' => $capsule));
    }

    public function modPost($id)
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Capsule - Modifier');

        // Vérifier la présence des différents champs transmis par le formulaire
        if (!(Input::has('titre') && Input::has('contenu') && Input::has('categorie_id')))
        {
            return $this->afficherErreur("Il y a des champs manquants");
        }
        if (!Auth::check()) 
        {
            return $this->afficherErreurWithInput("Vous devez être connecté pour modifier une capsule.");
        }

        // Allez chercher la capsule avec le id transmit
        $capsule = Capsule::findOrFail($id);

        // Modifier les champs de la bd avec les nouvelles valeurs
        $capsule->titre = htmlspecialchars(Input::get('titre'));
        $capsule->contenu = htmlspecialchars(Input::get('contenu'));

        try
        {
            // Enregistrer la capsule .save
            $capsule->save();
            return Redirect::to('/capsules/')->with('evenement', $params = array('message' => 'Modification réussie', 'reussi' => true));
        }
        catch (Exception $e)
        {
          return $this->afficherErreur("Erreur lors de l'insertion!");
        }
        // Return la page succes.
        return $this->afficherSucces('Modification réussie');
    }

    public function suppPost()
    {
        // Set titre page générée
        $proprietesPage = array('titre' => 'Capsule - Supprimer');

        try
        {
            // Allez chercher la capsule avec le id transmit
            $capsule = Capsule::findOrFail(Input::get("id"));

            // Allez chercher le nom de l'utilisateur et le titre de la capsule            
            $nom = $capsule->utilisateur()->nom;
            $titre = $capsule->titre;

            // Message de confirmation
            $message = '<p>Supression de :'. $titre .' publiée par :' . $nom . ' réussie.</p>';

            // Effacer la capsule et afficher la page succès.
            $capsule->delete($message);
            return $this->afficherSucces($message);
        }
        catch (Exception $e)
        {
            // Afficher la page erreur.
            return $this->afficherErreur("Capsule introuvable.");
        }
    }
}
?>