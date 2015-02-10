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

        // Enboite vue sinistres dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'alertes.lister',
                    array('alertes' => $alertes,
                          'lstCategories' => $lstCategories,
                          'categories' => $categories,
                          'catCourante' => $catCourante));
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
            return $this->afficherErreurWithInput($message);
        }

        try {
            $alerte = new Alerte;

            $alerte->contenu = $contenu;
            $alerte->lat = $lat;
            $alerte->long = $long;
            $alerte->categorie_id = $categorie_id;
            $alerte->utilisateur_id = Auth::user()->id;

            $alerte->save();

            try {
                $this->alerteSMS($alerte);
            } catch (Services_Twilio_RestException $e) {
                $message = "Erreur sms: " . $e->getMessage();
            }
        } catch(Exception $e) {
            $erreur = true;
            $message = "Erreur interne: " . $e->getMessage();
        }

        if (!$erreur) {
            return $this->afficherSuccesRedirect('/alertes/','Alerte enregistrée (pas diffusée).');
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

    private function alerteSMS($alerte)
    {
         
        $account_sid = 'ACb678338ab5442f0984af065905021252'; 
        $auth_token = ''; 
        $http = new Services_Twilio_TinyHttp(
            'https://api.twilio.com',
            array('curlopts' => array(
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
            )));

        $client = new Services_Twilio($sid, $token, "2010-04-01", $http);
         
        $client->account->messages->create(array( 
            'To' => "4189345616", 
            'From' => "+15817029591", 
            'Body' => "Alerte faireface.ca: " . $alerte->contenu . "\r\nfaireface.ca/a/" . $alerte->id,   
        ));
    }
}
?>