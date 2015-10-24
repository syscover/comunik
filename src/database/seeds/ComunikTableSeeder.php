<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ComunikTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call(ResourceComunikTableSeeder::class);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="ComunikTableSeeder"
 */