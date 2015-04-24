<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableGrupo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_029_grupo', function($table){
                $table->engine = 'InnoDB';
                $table->increments('id_029')->unsigned();
                $table->string('nombre_029',50);
                $table->timestamps();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('005_029_grupo');
	}

}