<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableContacto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_030_contacto', function($table){
                $table->engine = 'InnoDB';
                $table->increments('id_030')->unsigned();
                $table->string('empresa_030',100)->nullable();
                $table->string('nombre_030',50)->nullable();
                $table->string('apellidos_030',50)->nullable();
                $table->integer('nacimiento_030')->nullable()->unsigned();
                $table->string('pais_030',2)->index();
                $table->string('prefijo_030',5)->nullable();
                $table->string('movil_030',50)->nullable()->unique();
                $table->string('email_030',50)->nullable()->unique();
                $table->boolean('unsubscribe_movil_030')->default(false);
                $table->boolean('unsubscribe_email_030')->default(false);
                $table->timestamps();
                $table->foreign('pais_030')->references('id_002')->on('001_002_pais')
                        ->onDelete('restrict')->onUpdate('cascade');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('005_030_contacto');
	}

}