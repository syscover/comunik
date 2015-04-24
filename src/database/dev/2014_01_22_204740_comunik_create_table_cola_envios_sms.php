<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableColaEnviosSms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            
            //Esta tabla se crea sin $table->timestamps();, al realzar la inserciones en bulk no resgistra el timestamps
            Schema::create('005_064_cola_envios_sms', function($table){
                $table->engine = 'InnoDB';
                $table->bigIncrements('id_064')->unsigned();
                $table->integer('campana_064')->unsigned();
                $table->integer('contacto_064')->unsigned();
                $table->smallInteger('orden_064')->nullable()->unsigned()->default(0);
                // estado_056 = 0 sin manipular
                // estado_056 = 1 procesándose
                // estado_056 = 2 enviado
                $table->tinyInteger('estado_064')->unsigned()->default(0);
                $table->integer('creado_064')->unsigned();
                $table->foreign('campana_064')->references('id_049')->on('005_049_campana_sms')
                        ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('contacto_064')->references('id_030')->on('005_030_contacto')
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
            Schema::drop('005_064_cola_envios_sms');
	}

}