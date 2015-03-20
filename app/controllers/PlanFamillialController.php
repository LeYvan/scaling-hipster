<?php
class PlanFamillialController extends BaseController {
	public function afficher()
	{
  		$message = array(
  			'titre' => 'Plan famillial',
  			'jumbo' => false
  		);
  		return View::make('faireface', $message)->nest('contenu','planfamillial.plan');
  	}
}
?>