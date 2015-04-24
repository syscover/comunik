<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableHistoricoEnviosSms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_065_historico_envios_sms', function($table){
                $table->engine = 'InnoDB';
                $table->bigIncrements('id_065')->unsigned();
                $table->integer('campana_065')->unsigned();
                $table->integer('contacto_065')->unsigned();
                $table->integer('enviado_065')->unsigned();
                $table->foreign('campana_065')->references('id_049')->on('005_049_campana_sms')
                        ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('contacto_065')->references('id_030')->on('005_030_contacto')
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
            Schema::drop('005_065_historico_envios_sms');
	}

}