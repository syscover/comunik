<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableGroup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('005_040_group', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id_040')->unsigned();
			$table->string('name_040');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('005_040_group');
	}

}