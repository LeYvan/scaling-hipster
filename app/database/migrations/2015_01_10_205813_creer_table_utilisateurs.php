<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreerTableUtilisateurs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('utilisateurs',function($table)
		{
			$table->increments('id');

			$table->string('nomUtilisateur')->unique();
			$table->string('nom');
			$table->string('email');
			$table->integer('niveau');
			$table->string('password');

			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('categories_sinistres',function($table)
		{
			$table->increments('id');

			$table->string('etiquette')->unique();
			
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('sinistres',function($table)
		{
			$table->increments('id');
			$table->string('utilisateur_id')->references('id')->on('utilisateurs');
			$table->string('categorie_id')->references('id')->on('categoriesSinistres');

			$table->string('titre'); // ->unique(); (unique ou non?)
			$table->text('rapport');	
			$table->double('geo-x', 15, 8);
			$table->double('geo-y', 15, 8);
			$table->string('adresse');

			$table->boolean('afficher');

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('elements_sinistres',function($table)
		{

			$table->increments('id');
			$table->string('sinistre_id')->references('id')->on('sinistres');

			$table->enum('type', array('image', 'video'));
			$table->string('fichier');

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
		Schema::drop('utilisateurs');
		Schema::drop('categories_sinistres');
		Schema::drop('elements_sinistres');
		Schema::drop('sinistres');
	}

}
