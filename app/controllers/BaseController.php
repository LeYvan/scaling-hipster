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
      $params = array('message' => $message, 'reussi' => false);

        // Enboite vue sinistres dans vue design
        return Redirect::back()->with('evenement', $params);
    }

    public function afficherErreurWithInput($message = null)
    {
      $params = array('message' => $message, 'reussi' => false);
      $redirect = Redirect::back()->with('evenement', $params);
      $redirect->withInput();
      return $redirect;
    }

    public function afficherSucces($message = null)
    {
      $params = array('message' => $message, 'reussi' => true);

        // Enboite vue sinistres dans vue design
      return Redirect::back()->with('evenement', $params);
    }

    public function afficherSuccesRedirect($url,$message = null)
    {
      $params = array('message' => $message, 'reussi' => true);

        // Enboite vue sinistres dans vue design
      return Redirect::to($url)->with('evenement', $params);
    }


}
