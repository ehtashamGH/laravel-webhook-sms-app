<?php

namespace Database\Seeders;

use App\Models\MessageTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'message_id' => 'booking_confirmed',
                'subject' => 'Booking Confirmation',
                'body' => 'Hello {customer_name}, your booking {booking_id} has been confirmed! Thank you for choosing our service.',
            ],
            [
                'message_id' => 'enroute',
                'subject' => 'Driver En Route',
                'body' => 'Hi {customer_name}, your driver is on the way! Track your ride here: {tracking_link}. Contact: {mobile}',
            ],
            [
                'message_id' => 'completed',
                'subject' => 'Service Completed',
                'body' => 'Thank you {customer_name}! Your booking {booking_id} is now completed. We hope to serve you again soon!',
            ],
        ];

        foreach ($templates as $template) {
            MessageTemplate::create($template);
        }
    }
}
