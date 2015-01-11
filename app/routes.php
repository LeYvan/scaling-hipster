<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Route Sinistres */
Route::get('/sinistres/', function()
{

  // Setter titre page à générer.
  $proprietesPage = array('titre' => 'Sinistres');

  // Get all sinistres
  $sinistres = Sinistre::all();
  $categories = CategorieSinistre::all();

  // Enboite la vue des sinistres dans le design global
  // et passe les sinistres.
  return 
    View::make('faireface', $proprietesPage)
      ->nest('contenu',
             'sinistres.afficher-sinistres',
              array('sinistres' => $sinistres,
                    'categories' => $categories));
});

/* Route Page Accueil */
Route::get('/', function()
{

  $message = array('titre' => 'Accueil');

  return View::make('faireface', $message)->nest('contenu','accueil');
});

