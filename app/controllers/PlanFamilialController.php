<?php
class PlanFamilialController extends BaseController {

	public function afficher()
	{
  		$message = array(
  			'titre' => 'Plan Familial',
  			'jumbo' => false
  		);
  		return View::make('faireface', $message)->nest('contenu','planFamilial.plan');
  	}

		public function sauvegarder()
		{
			$erreur = false;
			$message = "";

			if (!Auth::check())
			{
				return Response::json(array(
					'success' => false,
					'message' => 'pas connecté'
				));
			}

			$json = htmlspecialchars(Input::get('json'));

			if (empty($json))
			{
					$erreur = true;
					$message = "Données invalides";
					return $this->afficherErreurWithInput($message);
			}

			try {
					$plan = null;

					if (Auth::check())
					{
						$plan = PlanFamilial::where('utilisateur_id',Auth::user()->id)->first();
					}

					if ($plan == null)
					{
						$plan = new PlanFamilial;
					}

					$plan->utilisateur_id = Auth::user()->id;
					$plan->json = $json;
					$plan->save();

			} catch(Exception $e) {
					$erreur = true;
					$message = "Erreur interne: " . $e->getMessage();
			}

			if (!$erreur) {
					return Response::json(array(
						'success' => true,
						'message' => 'Les informations sont bien enregistrées.'
					));
			} else {
				return Response::json(array(
					'success' => false,
					'message' => $message
				));
			}
		}

		public function recuperer()
		{
			$plan = null;

			if (Auth::check())
			{
				$plan = PlanFamilial::where('utilisateur_id',Auth::user()->id)->first();
			}



			if ($plan != null)
			{
				return Response::json(array(
					'success' => true,
					'json' =>  htmlspecialchars_decode($plan->json)
				));
			}
			else
			{
				return Response::json(array(
					'success' => false,
					'message' => 'Vous n\'avez pas d\'information sauvegardée'
				));
			}
		}
}
?>
