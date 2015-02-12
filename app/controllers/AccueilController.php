<?php
class AccueilController extends BaseController {
	public function afficher()
	{
  		$message = array(
  			'titre' => 'Accueil',
  			'jumbo' => true,
        'classe' => 'no-background'
  		);
  		return View::make('faireface', $message)->nest('contenu','accueil',
  			array(
          'alertes' => Alerte::orderBy('created_at', 'desc')->take(rand(1,3))->get(),
          'nouvelles' => Nouvelle::orderBy('created_at', 'desc')->take(rand(1,3))->get(),
          'capsules' => Capsule::orderBy('created_at', 'desc')->take(rand(1,3))->get(),
          'sinistres' => Sinistre::orderBy('created_at', 'desc')->take(rand(1,3))->get()
			)
		);
  	}
}
?>