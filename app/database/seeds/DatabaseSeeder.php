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
		$this->call('UtilisateursSeeder');
		$this->command->info('Table utilisateurs germée!');

		$this->call('CategoriesSinistresSeeder');
		$this->command->info('Table categories-sinistres germée!');

		$this->call('SinistresSeeder');
		$this->command->info('Table sinistres germée!');

    $this->call('ElementsSinistreSeeder');
    $this->command->info('Table elements-sinistre germée!');
    */

        DB::table('utilisateurs')->delete();
        $this->command->info('Table utilisateurs dropée!');

        $utilisateur1 = Utilisateur::create(array('nomUtilisateur' => 'bob',
                                 'nom' => 'Roger Gauthier',
                                 'email' => 'bob@faireface.com',
                                 'niveau' => 99,
                                 'password' => hash('sha256','caca')
                                )
                            );

        $utilisateur2 = Utilisateur::create(array('nomUtilisateur' => 'genevieve',
                                 'nom' => 'Geneviève Tremblay',
                                 'email' => 'gen69@faireface.com',
                                 'niveau' => 2,
                                 'password' => hash('sha256','pipi')
                                )
                             );

        $utilisateur3 = Utilisateur::create(array('nomUtilisateur' => 'ticul',
                                 'nom' => 'Stéphane Bobinette',
                                 'email' => 'stephentabarnaque@faireface.com',
                                 'niveau' => 1,
                                 'password' => hash('sha256','vagin')
                                )
                              );

        $this->command->info('Table utilisateurs germée!');


        DB::table('categories_sinistres')->delete();
        $this->command->info('Table categories_sinistres dropée!');

        CategorieSinistre::create(array('etiquette' => 'Autres'));
        CategorieSinistre::create(array('etiquette' => 'Délits'));
        CategorieSinistre::create(array('etiquette' => 'Accidents'));
        CategorieSinistre::create(array('etiquette' => 'Inondations'));
        CategorieSinistre::create(array('etiquette' => 'Déversements'));
        CategorieSinistre::create(array('etiquette' => 'Dérengements'));
        CategorieSinistre::create(array('etiquette' => 'Routiers'));

        $this->command->info('Table categories_sinistres germée!');


        DB::table('sinistres')->delete();
        $this->command->info('Table sinistres dropée!');

        $sinistre1 = Sinistre::create(array('utilisateur_id' => $utilisateur2->id,
                'categorie_id' => 1,
                'titre' => 'Sinistre sur la rue Morgue',
                'rapport' => 'Une femme fut insérée la tête en bas dans la cheminée d\'un foyer',
                'geo-x' => 0.12312312,
                'geo-y' => 1.12312434,
                'afficher' => true
              )
            );

        $sinistre2 = Sinistre::create(array('utilisateur_id' => $utilisateur3->id,
                'categorie_id' => 2,
                'titre' => 'Renversement d\'un camion citerne',
                'rapport' => 'Un camion renverse son contenu dans la rivière chaudière.',
                'geo-x' => 0.12312312,
                'geo-y' => 1.12312434,
                'afficher' => true
              )
            );

        $this->command->info('Table sinistres germée!');


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

        $this->command->info('Table elements_sinistres germée!');

	}

}

class UtilisateursSeeder extends Seeder {

    public function run()
    {
        DB::table('utilisateurs')->delete();

        Utilisateur::create(array('nomUtilisateur' => 'bob',
                								 'nom' => 'Roger Gauthier',
                								 'email' => 'bob@faireface.com',
                								 'niveau' => 99,
                								 'password' => hash('sha256','caca')
                								)
					       );

        Utilisateur::create(array('nomUtilisateur' => 'genevieve',
                								 'nom' => 'Geneviève Tremblay',
                								 'email' => 'gen69@faireface.com',
                								 'niveau' => 2,
                								 'password' => hash('sha256','pipi')
                								)
                					   );

        Utilisateur::create(array('nomUtilisateur' => 'ticul',
                								 'nom' => 'Stéphane Bobinette',
                								 'email' => 'stephentabarnaque@faireface.com',
                								 'niveau' => 1,
                								 'password' => hash('sha256','vagin')
                								)
                					       );
    }
}


class CategoriesSinistresSeeder extends Seeder {

    public function run()
    {
        DB::table('categories-sinistres')->delete();

        CategorieSinistre::create(array('etiquette' => 'Autres'));
        CategorieSinistre::create(array('etiquette' => 'Délits'));
        CategorieSinistre::create(array('etiquette' => 'Accidents'));
        CategorieSinistre::create(array('etiquette' => 'Inondations'));
    		CategorieSinistre::create(array('etiquette' => 'Déversements'));
    		CategorieSinistre::create(array('etiquette' => 'Dérengements'));
    		CategorieSinistre::create(array('etiquette' => 'Routiers'));
    }
}

class SinistresSeeder extends Seeder {

    public function run()
    {
        DB::table('sinistres')->delete();

        Sinistre::create(array('id-createur' => 2,
								'categorie' => 1,
								'titre' => 'Sinistre sur la rue Morgue',
								'rapport' => 'Une femme fut insérée la tête en bas dans la cheminée d\'un foyer',
								'geo-x' => 0.12312312,
								'geo-y' => 1.12312434,
								'afficher' => true
							)
						);

        Sinistre::create(array('id-createur' => 2,
								'categorie' => 2,
								'titre' => 'Renversement d\'un camion citerne',
								'rapport' => 'Un camion renverse son contenu dans la rivière chaudière.',
								'geo-x' => 0.12312312,
								'geo-y' => 1.12312434,
								'afficher' => true
							)
        				);
    }
}

class ElementsSinistreSeeder extends Seeder {

    public function run()
    {
        DB::table('elements-sinistre')->delete();

        ElementSinistre::create(array('idSinistre' => 0,
							          'type' => 'image',
                                      'fichier' => '2107862138761238976123.jpg'
        					         )
        		               );

        ElementSinistre::create(array('idSinistre' => 0,
                                      'type' => 'image',
                                      'fichier' => '9872097324678123123222.jpg'
                                     )
                               );
    }
}