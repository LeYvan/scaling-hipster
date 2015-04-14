<?php
class AideController extends BaseController {
	public function afficher()
	{
  		$message = array(
  			'titre' => 'Aide',
  		);
  		return View::make('faireface', $message)->nest('contenu','aide.afficher');
  	}
}
?>