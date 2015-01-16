<?php

// Groupe de route pour ADMIN SEULEMENT
Route::group(array('before' => 'auth|admin'), function() {

  Route::get('/utilisateurs/',
           'UtilisateursController@lister');

  Route::get('/utilisateurs/{id}',
             'UtilisateursController@modifierGet');

  Route::post('/utilisateurs/{id}',
             'UtilisateursController@modifierPost');

  Route::get('/utilisateurs/supprimer/{id}',
            'UtilisateursController@confirmationSupprimer');

  Route::post('/utilisateurs/{id}/supprimer/',
             'UtilisateursController@supprimer');

});

//======================================================================================================================

// Groupe de route pour ADMIN ET CONSEILLER SEULEMENT
Route::group(array('before' => 'auth|admin|conseiller'), function() {

  Route::get('/sinistres/modifier/{id}',        // Modifier GET
             'SinistresController@modifierGet');

  Route::post('/sinistres/modifier/{id}',       // Modifier POST
              'SinistresController@modifierPost');

  Route::get('/sinistres/{id}/supp/',           // Supprimer GET
              'SinistresController@confirmerSupprimer');

  Route::post('/sinistres/{id}/supp/',           // Supprimer POST
              'SinistresController@supprimer');

  Route::get('/elements-sinistres/supp/{id}',   // Supprimer GET
            'ElementsSinistreController@confirmerSupprimer');

  Route::post('/elements-sinistres/supp/',      // Supprimer POST
            'ElementsSinistreController@supprimer');

});
//======================================================================================================================

// Sinistres
Route::get('/sinistres/',      // Lister
           'SinistresController@lister');

Route::get('/sinistres/categorie/{categorie_id}',      // Lister
           'SinistresController@lister');

Route::get('/sinistres/ajouter/',             // Ajouter GET
          'SinistresController@ajouterGet'); 

Route::post('/sinistres/ajouter/',             // Ajouter POST
           'SinistresController@ajouterPost');

//======================================================================================================================

Route::post('/inscription/',
           'UtilisateursController@inscription');

//======================================================================================================================

// Accueil
Route::get('/', function()
{
  $message = array('titre' => 'Accueil', 'jumbo' => true);
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
	return Redirect::back()->with('evenement', $params);
});



Route::get('/deconnexion/', function(){
	Auth::logout();

  /*
  $params = array("reussi" => true, "message" => 'Deconnexion réussie!!');
  return Redirect::to('/')->with('evenement', $params);
  */

	return Redirect::back()->with('evenement', array("reussi" => true, "message" => 'Déconnecté!'));

});
