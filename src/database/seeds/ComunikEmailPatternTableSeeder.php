<?php

use Illuminate\Database\Seeder;
use Syscover\Comunik\Models\EmailPattern;

class ComunikEmailPatternTableSeeder extends Seeder {

    public function run()
    {
        EmailPattern::insert([
            ['name_049' => 'Undelivered Mail Returned to Sender (email account that you tried to reach is disabled)',           'subject_049' => 'Undelivered Mail Returned to Sender',                 'operator_049' => 'and',     'message_049' => 'email account that you tried to reach is disabled',                                  'action_049' => 3],
            ['name_049' => 'Delivery Status Notification (Delivery to the following recipients failed)',                        'subject_049' => 'Delivery Status Notification (Failure)',              'operator_049' => 'and',     'message_049' => 'Delivery to the following recipients failed',                                        'action_049' => 3],
            ['name_049' => 'Undelivered Mail Returned to Sender (MAILBOX IS FULL)',                                             'subject_049' => 'Undelivered Mail Returned to Sender',                 'operator_049' => 'and',     'message_049' => 'MAILBOX IS FULL',                                                                    'action_049' => 3],
            ['name_049' => 'Delivery Status Notification (Failure) (Unknown address error 550)',                                'subject_049' => 'Delivery Status Notification (Failure)',              'operator_049' => 'and',     'message_049' => 'Unknown address error 550',                                                          'action_049' => 3],
            ['name_049' => 'Undelivered Mail Returned to Sender (Recipient address rejected: User unknown)',                    'subject_049' => 'Undelivered Mail Returned to Sender',                 'operator_049' => 'and',     'message_049' => 'Recipient address rejected: User unknown',                                           'action_049' => 3],
            ['name_049' => 'Failure notice (mailfolder is full)',                                                               'subject_049' => 'failure notice',                                      'operator_049' => 'and',     'message_049' => 'mailfolder is full',                                                                 'action_049' => 3],
            ['name_049' => 'Failure notice (Remote host said: 451 unable to verify sender)',                                    'subject_049' => 'failure notice',                                      'operator_049' => 'and',     'message_049' => 'Remote host said: 451 unable to verify sender',                                      'action_049' => 3],
            ['name_049' => 'Warning: message (Delay reason: mailbox is full)',                                                  'subject_049' => 'failure notice',                                      'operator_049' => 'and',     'message_049' => 'Delay reason: mailbox is full',                                                      'action_049' => 3],
            ['name_049' => 'Mail delivery failed: returning message to sender (mailbox is full: retry timeout exceeded)',       'subject_049' => 'Mail delivery failed: returning message to sender',   'operator_049' => 'and',     'message_049' => 'mailbox is full: retry timeout exceeded',                                            'action_049' => 3],
            ['name_049' => 'Undelivered Mail Returned to Sender (unknown in virtual mailbox)',                                  'subject_049' => 'Undelivered Mail Returned to Sender',                 'operator_049' => 'and',     'message_049' => 'unknown in virtual mailbox',                                                         'action_049' => 3],
            ['name_049' => 'Undelivered Mail Returned to Sender (This is a spam mail)',                                         'subject_049' => 'Undelivered Mail Returned to Sender',                 'operator_049' => 'and',     'message_049' => 'This is a spam mail',                                                                'action_049' => 6],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="ComunikEmailPatternTableSeeder"
 */