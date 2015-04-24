<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableCampanasPaisesSms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_063_campanas_paises_sms', function($table){
                $table->engine = 'InnoDB';
                $table->integer('campana_063')->unsigned();
                $table->string('pais_063',2);
                $table->primary(array('campana_063', 'pais_063'));
                $table->foreign('campana_063')->references('id_049')->on('005_049_campana_sms')
                        ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('pais_063')->references('id_002')->on('001_002_pais')
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
            Schema::drop('005_063_campanas_paises_sms');
	}

}