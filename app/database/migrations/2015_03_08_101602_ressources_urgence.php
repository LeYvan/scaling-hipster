<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RessourcesUrgence extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('ressources',function($table)
		{
			$table->increments('id');

			$table->string('nom')->unique();
			$table->string('email');
			$table->string('telephone');
			$table->string('url');
			$table->string('description');

			$table->string('categorie_id')->references('id')->on('categories_sinistres');

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('planFamillials',function($table)
		{
			$table->increments('id');

			$table->string('utilisateur_id')->references('id')->on('utilisateurs');
			$table->longText('json');

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
		Schema::drop('ressources');
		Schema::drop('planFamillials');
	}

}
