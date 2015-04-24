<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableColaEnviosEmails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            
            //Esta tabla se crea sin $table->timestamps();, al realzar la inserciones en bulk no resgistra el timestamps
            Schema::create('005_056_cola_envios_emails', function($table){
                $table->engine = 'InnoDB';
                $table->bigIncrements('id_056')->unsigned();
                $table->integer('campana_056')->unsigned();
                $table->integer('contacto_056')->unsigned();
                $table->smallInteger('orden_056')->nullable()->unsigned()->default(0);
                // estado_056 = 0 sin manipular
                // estado_056 = 1 procesándose
                // estado_056 = 2 enviado
                $table->tinyInteger('estado_056')->unsigned()->default(0);
                $table->integer('creado_056')->unsigned();
                $table->foreign('campana_056')->references('id_048')->on('005_048_campana_email')
                        ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('contacto_056')->references('id_030')->on('005_030_contacto')
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
            Schema::drop('005_056_cola_envios_emails');
	}

}