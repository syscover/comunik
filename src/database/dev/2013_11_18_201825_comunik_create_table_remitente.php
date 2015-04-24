<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableRemitente extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_045_remitente', function($table){
                $table->engine = 'InnoDB';
                $table->increments('id_045')->unsigned();
                $table->string('nombre_045',11);
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
            Schema::drop('005_045_remitente');
	}

}