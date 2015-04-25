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
            Schema::create('005_029_group', function($table){
                $table->engine = 'InnoDB';
                $table->increments('id_029')->unsigned();
                $table->string('name_029',50);
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('005_029_group');
	}

}