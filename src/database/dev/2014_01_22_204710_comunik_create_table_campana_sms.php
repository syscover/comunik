<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableCampanaSms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_049_campana_sms', function($table){
                $table->engine = 'InnoDB';
                $table->increments('id_049')->unsigned();
                $table->string('nombre_049',100);
                $table->integer('plantilla_049')->unsigned();
                $table->integer('remitente_049')->unsigned();
                $table->text('mensaje_049');
                $table->integer('fecha_envio_049')->nullable()->unsigned()->default(0);
                $table->integer('fecha_persistencia_049')->nullable()->unsigned()->default(0);
                $table->smallInteger('orden_049')->nullable()->unsigned()->default(0);
                $table->boolean('creada_049')->default(false);
                $table->boolean('enviada_049')->default(false);
                $table->timestamps();
                $table->foreign('remitente_049')->references('id_045')->on('005_045_remitente')
                        ->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('plantilla_049')->references('id_046')->on('005_046_plantilla_sms')
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
            Schema::drop('005_049_campana_sms');
	}

}