<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Resource;

class ResourceComunikTableSeeder extends Seeder {

    public function run()
    {
        Resource::insert([
            ['id_007' => 'comunik','name_007' => 'Comunik Package','package_007' => '3'],
            ['id_007' => 'comunik-contact','name_007' => 'Contacts','package_007' => '3'],
            ['id_007' => 'comunik-group','name_007' => 'Groups','package_007' => '3'],
            ['id_007' => 'comunik-email-campaign','name_007' => 'Email services -- Campaigns','package_007' => '3'],
            ['id_007' => 'comunik-email-sending','name_007' => 'Email services -- Sendings','package_007' => '3'],
            ['id_007' => 'comunik-email-template','name_007' => 'Email services -- Templates','package_007' => '3'],
            ['id_007' => 'comunik-email-preference','name_007' => 'Email services -- Preferences','package_007' => '3'],
            ['id_007' => 'comunik-email-message','name_007' => 'Email services -- Messages','package_007' => '3'],
            ['id_007' => 'comunik-email-pattern','name_007' => 'Email patterns -- Patterns','package_007' => '3'],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="ResourceComunikTableSeeder"
 */