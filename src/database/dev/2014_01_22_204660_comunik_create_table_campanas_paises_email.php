<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableCampanasPaisesEmail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_061_campanas_paises_email', function($table){
                $table->engine = 'InnoDB';
                $table->integer('campana_061')->unsigned();
                $table->string('pais_061',2);
                $table->primary(array('campana_061', 'pais_061'));
                $table->foreign('campana_061')->references('id_048')->on('005_048_campana_email')
                        ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('pais_061')->references('id_002')->on('001_002_pais')
                        ->onDelete('cascade')->onUpdate('cascade');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('005_061_campanas_paises_email');
	}

}