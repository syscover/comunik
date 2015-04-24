<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableCampanasGruposSms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_062_campanas_grupos_sms', function($table){
                $table->engine = 'InnoDB';
                $table->integer('campana_062')->unsigned();
                $table->integer('grupo_062')->unsigned();
                $table->primary(array('campana_062', 'grupo_062'));
                $table->foreign('campana_062')->references('id_049')->on('005_049_campana_sms')
                        ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('grupo_062')->references('id_029')->on('005_029_grupo')
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
            Schema::drop('005_062_campanas_grupos_sms');
	}

}