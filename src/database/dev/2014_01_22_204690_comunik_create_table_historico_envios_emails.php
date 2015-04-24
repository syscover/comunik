<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableHistoricoEnviosEmails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_060_historico_envios_emails', function($table){
                $table->engine = 'InnoDB';
                $table->bigIncrements('id_060')->unsigned();
                $table->bigInteger('cola_envio_060')->unsigned();
                $table->integer('campana_060')->unsigned();
                $table->integer('contacto_060')->unsigned();
                $table->integer('enviado_060')->unsigned();
                $table->integer('visto_060')->unsigned()->default(0); //contabiliza en número de veces que se ha visualizado
                $table->foreign('cola_envio_060')->references('id_056')->on('005_056_cola_envios_emails')
                    ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('campana_060')->references('id_048')->on('005_048_campana_email')
                    ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('contacto_060')->references('id_030')->on('005_030_contacto')
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
            Schema::drop('005_060_historico_envios_emails');
	}

}