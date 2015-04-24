<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableCampanaEmail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_048_campana_email', function($table){
                $table->engine = 'InnoDB';
                $table->increments('id_048')->unsigned();
                $table->string('nombre_048',100);
                $table->integer('cuenta_048')->unsigned();
                $table->integer('plantilla_048')->nullable()->unsigned();
                $table->string('asunto_048',255);
                $table->string('theme_048',255);
                $table->text('header_048');
                $table->text('body_048');
                $table->text('footer_048');
                $table->text('text_048');
                $table->text('data_048');
                $table->integer('fecha_envio_048')->nullable()->unsigned()->default(0);
                $table->integer('fecha_persistencia_048')->nullable()->unsigned()->default(0);
                $table->smallInteger('orden_048')->nullable()->unsigned()->default(0);
                $table->boolean('creada_048')->default(false);
                $table->boolean('enviada_048')->default(false);
                $table->integer('visto_048')->unsigned()->default(0);
                $table->timestamps();
                $table->foreign('cuenta_048')->references('id_047')->on('005_047_cuenta')
                        ->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('plantilla_048')->references('id_058')->on('005_058_plantilla_email')
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
            Schema::drop('005_048_campana_email');
	}

}