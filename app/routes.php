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

Route::get('/sinistres/{categorie_id?}', 'SinistresController@lister');

/* Route Page Accueil */
Route::get('/', function()
{

  $message = array('titre' => 'Accueil');

  return View::make('faireface', $message)->nest('contenu','accueil');
});

