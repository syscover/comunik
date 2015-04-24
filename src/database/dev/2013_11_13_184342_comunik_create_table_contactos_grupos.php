<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableContactosGrupos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_044_contactos_grupos', function($table){
                $table->engine = 'InnoDB';
                $table->integer('contacto_044')->unsigned();
                $table->integer('grupo_044')->unsigned();
                $table->primary(array('contacto_044', 'grupo_044'));
                $table->foreign('contacto_044')->references('id_030')->on('005_030_contacto')
                        ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('grupo_044')->references('id_029')->on('005_029_grupo')
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
            Schema::drop('005_044_contactos_grupos');
	}

}