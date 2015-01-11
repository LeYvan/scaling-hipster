<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    public function afficherErreur($message = null)
    {
      $proprietesPage = array('titre' => 'Modifier un sinistres');

        // Enboite vue sinistres dans vue design
        return 
          View::make('faireface', $proprietesPage)
            ->nest('contenu',
                   'erreur',
                   array('message' => $message));
    }


}
