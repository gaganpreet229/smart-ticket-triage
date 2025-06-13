<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $tickets = [
            ['subject' => 'Payment failed', 'body' => 'I tried to pay but got an error'],
            ['subject' => 'Bug in login page', 'body' => 'The login button does not work'],
            ['subject' => 'New feature request', 'body' => 'Can you add dark mode?'],
            ['subject' => 'General inquiry', 'body' => 'What are your business hours?'],
            ['subject' => 'Unable to reset password', 'body' => 'I didn’t receive the reset email'],
            ['subject' => 'Account locked', 'body' => 'My account is locked after too many attempts'],
            ['subject' => 'Email not verified', 'body' => 'I clicked the link but it says expired'],
            ['subject' => 'Feature not working', 'body' => 'The export to CSV button doesn’t do anything'],
            ['subject' => 'App crashing', 'body' => 'The app crashes when I open the profile page'],
            ['subject' => 'Incorrect billing', 'body' => 'I was charged twice this month'],
            ['subject' => 'Unable to upload file', 'body' => 'I get a timeout when uploading images'],
            ['subject' => 'Need invoice copy', 'body' => 'Can you send me last month’s invoice?'],
            ['subject' => 'How to update profile?', 'body' => 'I can’t find the edit option on my profile'],
            ['subject' => 'Mobile version issues', 'body' => 'The site layout breaks on my iPhone'],
            ['subject' => 'Suggestion for improvement', 'body' => 'It would be helpful to sort by date'],
            ['subject' => 'Refund request', 'body' => 'I’d like a refund for my recent purchase'],
            ['subject' => 'Language support', 'body' => 'Do you offer the app in Spanish?'],
            ['subject' => 'Notification not received', 'body' => 'I didn’t get an alert for the last update'],
            ['subject' => 'Two-factor not working', 'body' => 'I can’t log in with my 2FA code'],
            ['subject' => 'How to delete account?', 'body' => 'Please guide me on deleting my account']
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}