<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableCampanasGruposEmail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_059_campanas_grupos_email', function($table){
                $table->engine = 'InnoDB';
                $table->integer('campana_059')->unsigned();
                $table->integer('grupo_059')->unsigned();
                $table->primary(array('campana_059', 'grupo_059'));
                $table->foreign('campana_059')->references('id_048')->on('005_048_campana_email')
                        ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('grupo_059')->references('id_029')->on('005_029_grupo')
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
            Schema::drop('005_059_campanas_grupos_email');
	}

}