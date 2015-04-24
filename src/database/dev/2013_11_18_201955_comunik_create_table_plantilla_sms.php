<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTablePlantillaSms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_046_plantilla_sms', function($table){
                $table->engine = 'InnoDB';
                $table->increments('id_046')->unsigned();
                $table->string('nombre_046',100);
                $table->integer('remitente_046')->unsigned();
                $table->text('mensaje_046');
                $table->timestamps();
                $table->foreign('remitente_046')->references('id_045')->on('005_045_remitente')->onDelete('restrict')->onUpdate('cascade');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('005_046_plantilla');
	}

}