<?php

use Illuminate\Database\Seeder;
use Syscover\Comunik\Models\EmailPattern;

class ComunikEmailPatternTableSeeder extends Seeder {

    public function run()
    {
        EmailPattern::insert([
            ['name_049' => 'Undelivered Mail Returned to Sender',       'subject_049' => 'Undelivered Mail Returned to Sender',         'operator_049' => 'and',     'message_049' => 'email account that you tried to reach is disabled',      'action_049' => 2],
            ['name_049' => 'Delivery Status Notification',              'subject_049' => 'Delivery Status Notification (Failure)',      'operator_049' => 'and',     'message_049' => 'Delivery to the following recipients failed',            'action_049' => 2],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="ComunikEmailPatternTableSeeder"
 */