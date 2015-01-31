<?php
require_once('utils.php');

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
     $this->command->info("Regénération des enregistrements de la BD.");

    // Appel le seeder de la phase 1 du site
    $this->call('UtilisateursSinistresSeeder');

    // Appel les seeders de la phase 2
    $this->call('AlertesSeeder');
    $this->call('NouvellesSeeder');
    $this->call('CapsulesSeeder');
	}

}
