<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableEmailSendHistory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (! Schema::hasTable('005_048_email_send_history') && ! Schema::hasTable('005_048_email_send_historical'))
        {
            Schema::create('005_048_email_send_history', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->bigIncrements('id_048')->unsigned();
                $table->bigInteger('send_queue_id_048')->unsigned()->nullable();
                $table->integer('campaign_id_048')->unsigned();
                $table->integer('contact_id_048')->unsigned();

                // date when he was created
                $table->integer('create_048')->unsigned();
                
                // date when he was sent
                $table->integer('sent_048')->unsigned();
                
                // count number times has been seen
                $table->integer('viewed_048')->unsigned()->default(0);

                $table->foreign('send_queue_id_048', 'fk01_005_048_email_send_history')
                    ->references('id_047')
                    ->on('005_047_email_send_queue')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
                $table->foreign('campaign_id_048', 'fk02_005_048_email_send_history')
                    ->references('id_044')
                    ->on('005_044_email_campaign')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                $table->foreign('contact_id_048', 'fk03_005_048_email_send_history')
                    ->references('id_041')
                    ->on('005_041_contact')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('005_048_email_send_history');
	}
}