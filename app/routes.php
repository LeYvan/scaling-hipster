<?php


// Sinistres
Route::get('/sinistres/{categorie_id?}',
           'SinistresController@lister');

Route::get('/sinistres/ajouter/',
           'SinistresController@ajouterGet');

Route::get('/sinistres/modifier/{id}',
           'SinistresController@modifierGet');

Route::post('/sinistres/modifier/{id}',
            'SinistresController@modifierPost');

Route::get('/elements-sinistres/supp/{id}',
          'ElementsSinistreController@confirmerSupprimer');

Route::post('/elements-sinistres/supp/',
          'ElementsSinistreController@supprimer');

Route::get('/utilisateur/supp/',
          'ElementsSinistreController@supprimer');

// Accueil
Route::get('/', function()
{
  $message = array('titre' => 'Accueil');
  return View::make('faireface', $message)->nest('contenu','accueil');
});



Route::post('/connexion/', function(){
	$reussi = Auth::attempt(array('nomUtilisateur' => Input::get("nomUtilisateur"), 'password' => Input::get("motPasse")));
	if ($reussi)
	{
		$params = array("reussi" => true, "message" => 'Connexion réussie!');
	} else {
		$params = array("reussi" => false, "message" => 'La connexion a échouée!');		
	}
	return Redirect::to('/')->with('evenement', $params);
});



Route::get('/deconnexion/', function(){
	Auth::logout();
	return Redirect::to('/')->with(array("reussi" => true, "message" => 'Connexion réussie!'));
});
