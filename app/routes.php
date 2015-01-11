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

// Accueil
Route::get('/', function()
{
  $message = array('titre' => 'Accueil');
  return View::make('faireface', $message)->nest('contenu','accueil');
});