<?php

use Illuminate\Database\Seeder;
use Syscover\Comunik\Models\EmailPattern;

class ComunikEmailPatternTableSeeder extends Seeder {

    public function run()
    {
        EmailPattern::insert([
            ['name_049' => 'Undelivered Mail Returned to Sender',               'subject_049' => 'Undelivered Mail Returned to Sender',                 'operator_049' => 'and',     'message_049' => 'email account that you tried to reach is disabled',                                  'action_049' => 3],
            ['name_049' => 'Delivery Status Notification',                      'subject_049' => 'Delivery Status Notification (Failure)',              'operator_049' => 'and',     'message_049' => 'Delivery to the following recipients failed',                                        'action_049' => 3],
            ['name_049' => 'Undelivered Mail Returned to Sender',               'subject_049' => 'Undelivered Mail Returned to Sender',                 'operator_049' => 'and',     'message_049' => 'MAILBOX IS FULL',                                                                    'action_049' => 3],
            ['name_049' => 'Delivery Status Notification (Failure)',            'subject_049' => 'Delivery Status Notification (Failure)',              'operator_049' => 'and',     'message_049' => 'Unknown address error 550',                                                          'action_049' => 3],
            ['name_049' => 'Undelivered Mail Returned to Sender',               'subject_049' => 'Undelivered Mail Returned to Sender',                 'operator_049' => 'and',     'message_049' => 'Recipient address rejected: User unknown',                                           'action_049' => 3],
            ['name_049' => 'Failure notice',                                    'subject_049' => 'failure notice',                                      'operator_049' => 'and',     'message_049' => 'The e-mail message could not be delivered because the user\'s mailfolder is full',   'action_049' => 3],
            ['name_049' => 'Failure notice',                                    'subject_049' => 'failure notice',                                      'operator_049' => 'and',     'message_049' => 'Remote host said: 451 unable to verify sender',                                      'action_049' => 3],
            ['name_049' => 'Warning: message',                                  'subject_049' => 'failure notice',                                      'operator_049' => 'and',     'message_049' => 'Delay reason: mailbox is full',                                                      'action_049' => 3],
            ['name_049' => 'Mail delivery failed: returning message to sender', 'subject_049' => 'Mail delivery failed: returning message to sender',   'operator_049' => 'and',     'message_049' => 'mailbox is full: retry timeout exceeded',                                            'action_049' => 3],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="ComunikEmailPatternTableSeeder"
 */