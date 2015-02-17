<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreerAlertesNouvellesCapsules extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alertes',function($table)
		{
			$table->increments('id');

			$table->string('categorie_id')->references('id')->on('categories_sinistres');
			$table->string('utilisateur_id')->references('id')->on('utilisateurs');

			$table->string('contenu');

			$table->double('lat', 15, 8);
			$table->double('long', 15, 8);

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('nouvelles',function($table)
		{
			$table->increments('id');

			$table->string('utilisateur_id')->references('id')->on('utilisateurs');

			$table->string('contenu');
			$table->string('titre');

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('capsules',function($table)
		{
			$table->increments('id');

			$table->string('utilisateur_id')->references('id')->on('utilisateurs');
			$table->string('categorie_id')->references('id')->on('categories_sinistres');

			$table->string('contenu');
			$table->string('titre');

			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alertes');
		Schema::drop('capsules');
		Schema::drop('nouvelles');
	}

}
