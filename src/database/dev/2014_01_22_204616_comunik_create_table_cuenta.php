<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableCuenta extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_047_cuenta', function($table){
                $table->engine = 'InnoDB';
                $table->increments('id_047')->unsigned();
                $table->string('nombre_047',100);
                $table->string('email_047',100);
                $table->string('reply_to_047',100)->nullable();
                $table->string('host_smtp_047',100);
                $table->string('user_smtp_047',100);
                $table->string('pass_smtp_047',255);
                $table->smallInteger('port_smtp_047');
                $table->string('secure_smtp_047',5);                // null/TLS/SSL/SSLv2/SSLv3
                $table->string('host_inbox_047',100);
                $table->string('user_inbox_047',100);
                $table->string('pass_inbox_047',255);
                $table->smallInteger('port_inbox_047');
                $table->string('secure_inbox_047',5);               // null/SSL
                $table->string('type_inbox_047',5);                 // pop, imap, mbox
                $table->integer('n_emails_047')->unsigned();
                $table->integer('last_check_uid_047')->unsigned();  // campo que registra el último uid comprobado, para saber si hay más mensajes rebotados a comprobar
                $table->timestamps();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('005_047_cuenta');
	}
}