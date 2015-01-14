<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        /* 
          ============================================
            Table utilisateurs
          ============================================
        */
        DB::table('utilisateurs')->delete();
        $this->command->info('Table utilisateurs dropée!');

        $utilisateurs = array();

        $utilisateurs[1] = Utilisateur::create(array('nomUtilisateur' => 'bob',
                                 'nom' => 'Roger Gauthier',
                                 'email' => 'bob@faireface.com',
                                 'niveau' => 99,
                                 'password' => Hash::make('caca')
                                )
                            );

        $utilisateurs[2] = Utilisateur::create(array('nomUtilisateur' => 'genevieve',
                                 'nom' => 'Geneviève Tremblay',
                                 'email' => 'gen69@faireface.com',
                                 'niveau' => 2,
                                 'password' => Hash::make('pipi')
                                )
                             );

        $utilisateurs[3] = Utilisateur::create(array('nomUtilisateur' => 'ticul',
                                 'nom' => 'Stéphane Bobinette',
                                 'email' => 'stephentabarnaque@faireface.com',
                                 'niveau' => 1,
                                 'password' => Hash::make('vagin')
                                )
                              );

        $utilisateurs[4] = Utilisateur::create(array('nomUtilisateur' => 'jose',
                                 'nom' => 'José Terminal',
                                 'email' => 'jose@faireface.com',
                                 'niveau' => 1,
                                 'password' => Hash::make('vagin')
                                )
                              );

        for ($i = 1; $i <= 666; $i++)
        {
          Utilisateur::create(array('nomUtilisateur' => 'utilisateur' . $i,
                                   'nom' => 'Utilisateur Fantôme Nb' . $i,
                                   'email' => mt_rand(1,99999) . '@faireface.com',
                                   'niveau' => 1,
                                   'password' => Hash::make('utilisateur'.$i)
                                  )
                                );
        }

        $this->command->info('Table utilisateurs germée!');


        /* 
          ============================================
            Table categories_sinistres
          ============================================
        */
        DB::table('categories_sinistres')->delete();
        $this->command->info('Table categories_sinistres dropée!');

        $categories = array();

        $categories[1] = CategorieSinistre::create(array('etiquette' => 'Autres'));
        $categories[2] = CategorieSinistre::create(array('etiquette' => 'Délits'));
        $categories[3] = CategorieSinistre::create(array('etiquette' => 'Accidents'));
        $categories[4] = CategorieSinistre::create(array('etiquette' => 'Inondations'));
        $categories[5] = CategorieSinistre::create(array('etiquette' => 'Déversements'));
        $categories[6] = CategorieSinistre::create(array('etiquette' => 'Dérengements'));
        $categories[7] = CategorieSinistre::create(array('etiquette' => 'Routiers'));

        $this->command->info('Table categories_sinistres germée!');


        DB::table('sinistres')->delete();
        $this->command->info('Table sinistres dropée!');

        $sinistre1 = Sinistre::create(array('utilisateur_id' => $utilisateurs[2]->id,
                'categorie_id' => $categories[1]->id,
                'titre' => 'Sinistre sur la rue Morgue',
                'rapport' => 'Une femme fut insérée la tête en bas dans la cheminée d\'un foyer',
                'geo-x' => 0.12312312,
                'geo-y' => 1.12312434,
                'afficher' => true
              )
            );

        $sinistre2 = Sinistre::create(array('utilisateur_id' => $utilisateurs[3]->id,
                'categorie_id' => $categories[2]->id,
                'titre' => 'Renversement d\'un camion citerne',
                'rapport' => 'Un camion renverse son contenu dans la rivière chaudière.',
                'geo-x' => 0.12312312,
                'geo-y' => 1.12312434,
                'afficher' => true
              )
            );

        $sinistres = array();
        for ($i = 1; $i <= 5000; $i++)
        {
          $sinistres[] = Sinistre::create(array('utilisateur_id' => $utilisateurs[mt_rand(3,4)]->id,
                          'categorie_id' => $categories[mt_rand(1,7)]->id,
                          'titre' => 'Lorem ipsum dolor sit amet(' . mt_rand(0,123821987213) . '), consectetur adipiscing elit.',
                          'rapport' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus rhoncus ligula nisl, quis hendrerit justo sodales vitae. Nullam fermentum lobortis sapien vel convallis. Ut congue, quam nec porta dignissim, enim purus bibendum nisl, ut posuere augue urna eu felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse nec nunc convallis, hendrerit metus eu, vestibulum turpis. Vestibulum vestibulum eu odio nec imperdiet. Donec quis nunc ut enim posuere pulvinar.
                          Donec gravida vitae nibh at dignissim. Nunc bibendum felis a interdum vulputate. Duis ac erat vel enim bibendum consequat. Aenean lacus quam, congue nec auctor ac, congue fermentum est. In lobortis dictum risus. Donec quis auctor diam. Aenean eget diam lorem. Cras vel sem tellus. Nunc at velit convallis, suscipit tortor id, malesuada ipsum. Fusce at pulvinar nunc. Integer quis venenatis mauris, at blandit leo. Integer pellentesque scelerisque auctor. Nam nec quam eget risus laoreet pulvinar in eu mi. Nulla sodales eros ligula, congue rhoncus enim blandit vel. Suspendisse aliquet, urna vitae pulvinar laoreet, purus libero aliquet sem, non pretium mauris mi vel neque. Integer sodales molestie urna, nec feugiat felis mollis nec.
                          Nulla mattis urna odio, a fermentum tellus lacinia feugiat. Vestibulum metus ex, condimentum aliquet mauris non, consectetur maximus ex. Fusce lectus ipsum, euismod suscipit metus a, posuere volutpat enim. Suspendisse venenatis arcu et massa rutrum, ac porta nulla consequat. Nullam mauris lorem, posuere et ultricies nec, dapibus a lectus. Aenean non erat venenatis, varius dui dignissim, pellentesque orci. Nunc non ex vitae nulla.',
                          'geo-x' => 0.12312312,
                          'geo-y' => 1.12312434,
                          'afficher' => true
                        )
                      );
        }

        $this->command->info('Table sinistres germée!');

        /* 
          ============================================
            Table elements_sinistres
          ============================================
        */
        DB::table('elements_sinistres')->delete();
        $this->command->info('Table elementsSinistre dropée!');

        ElementSinistre::create(array('sinistre_id' => $sinistre1->id,
                        'type' => 'image',
                                      'fichier' => '2107862138761238976123.jpg'
                           )
                           );

        ElementSinistre::create(array('sinistre_id' => $sinistre2->id,
                                      'type' => 'image',
                                      'fichier' => '9872097324678123123222.jpg'
                                     )
                               );

        for ($i = 1; $i <= 10000; $i++)
        {
          ElementSinistre::create(array('sinistre_id' => $sinistres[mt_rand(1,4999)]->id,
                                        'type' => 'image',
                                        'fichier' => mt_rand(1,9999999999) . '.jpg'
                                       )
                                 );
        }

        $this->command->info('Table elements_sinistres germée!');

	}

}