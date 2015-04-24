<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Resource;

class ResourceComunikTableSeeder extends Seeder {

    public function run()
    {
        Resource::insert([
            ['id_007' => 'comunik','name_007' => 'Comunik Package','package_007' => '3']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="ResourceComunikTableSeeder"
 */