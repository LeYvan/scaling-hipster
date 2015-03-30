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
Route::group(array('before' => 'auth|admin', 'before' => 'auth|conseiller'), function() {

  Route::get('/sinistres/modifier/{id}',        // Modifier GET
             'SinistresController@modifierGet');

  Route::post('/sinistres/modifier/{id}',       // Modifier POST
              'SinistresController@modifierPost');

  Route::post('/ressources/{id}/supp/',           // Supprimer POST
              'RessourcesController@supprimer');

  Route::post('/sinistres/{id}/supp/',           // Supprimer POST
              'SinistresController@supprimer');

  Route::get('/elements-sinistres/supp/{id}',   // Supprimer GET
            'ElementsSinistreController@confirmerSupprimer');

  Route::post('/elements-sinistres/supp/',      // Supprimer POST
            'ElementsSinistreController@supprimer');

  Route::get ('/alertes/publier/',        'AlertesController@publierGet');
  Route::post('/alertes/publier/',        'AlertesController@publierPost');

  Route::get ('/nouvelles/ajouter/',        'NouvellesController@ajouterGet');
  Route::post('/nouvelles/ajouter/',        'NouvellesController@ajouterPost');
  Route::post('/nouvelles/{id}/supprimer/', 'NouvellesController@suppPost');
  Route::get ('/nouvelles/{id}/modifier/',  'NouvellesController@modGet');
  Route::post('/nouvelles/{id}/modifier/',  'NouvellesController@modPost');

  Route::get ('/capsules/ajouter/',         'CapsulesController@ajouterGet');
  Route::post('/capsules/ajouter/',         'CapsulesController@ajouterPost');
  Route::post('/capsules/{id}/supprimer/',  'CapsulesController@suppPost');
  Route::get ('/capsules/{id}/modifier/',   'CapsulesController@modGet');
  Route::post('/capsules/{id}/modifier/',   'CapsulesController@modPost');

});
//======================================================================================================================

  Route::get('/profile/',
             'UtilisateursController@profileGet');

  Route::post('/profile/{id}',
             'UtilisateursController@profilePost');

  //unsubscribeSms
  Route::get('/profile/unsub/',
             'UtilisateursController@unsubscribeSms');

  Route::get('/alertes/{id}',
             'AlertesController@details');

    Route::get('/a/{id}',
             'AlertesController@details');

// Sinistres
Route::get('/sinistres/',      // Lister
           'SinistresController@lister');

Route::get('/sinistres/categorie/{etiquette}',      // Lister
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
Route::get('/', 'AccueilController@afficher');

Route::get ('/alertes/',                'AlertesController@lister');
Route::get ('/alertes/categories/{etiquette}', 'AlertesController@lister');

Route::get ('/nouvelles/',                'NouvellesController@lister');


Route::get ('/capsules/',                 'CapsulesController@lister');
Route::get ('/capsules/categories/{etiquette}', 'CapsulesController@lister');

Route::get ('/capsules/catégories/{id}',  'CapsulesController@lister');

Route::get ('/plan/',  'PlanFamilialController@afficher');
Route::post ('/plan/sauvegarder/',  'PlanFamilialController@sauvegarder');
Route::post ('/plan/recuperer/',  'PlanFamilialController@recuperer');

Route::post('/connexion/','UtilisateursController@connexion');
Route::get('/deconnexion/', 'UtilisateursController@deconnexion');



Route::get('/ressources/', 'RessourcesController@Lister');
Route::get('/ressources/categories/{etiquette}', 'RessourcesController@lister');

Route::get('/ressources/ajouter/', 'RessourcesController@AjouterGet');
Route::post('/ressources/ajouter/', 'RessourcesController@AjouterPost');

Route::get('/ressources/{id}/modifier/', 'RessourcesController@ModifierGet');
Route::post('/ressources/{id}/modifier/', 'RessourcesController@ModifierPost');
