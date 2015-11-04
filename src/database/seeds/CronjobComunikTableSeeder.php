<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\CronJob;

class CronjobComunikTableSeeder extends Seeder {

    public function run()
    {   
        CronJob::insert([
            ['name_011' => 'Check to create campaigns', 'package_011' => 3, 'cron_expression_011' => '*/5 * * * *', 'key_011' => '03', 'last_run_011' => 0, 'next_run_011' => 0, 'active_011' => 1],
            ['name_011' => 'Check to send emails', 'package_011' => 3, 'cron_expression_011' => '*/5 * * * *', 'key_011' => '04', 'last_run_011' => 0, 'next_run_011' => 0, 'active_011' => 1]
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="CronjobComunikTableSeeder"
 */