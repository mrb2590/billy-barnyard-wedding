<?php

namespace App\Console\Commands;

use App\Mail\ReminderAndItinerary;
use App\Models\Guest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminderAndItineraryEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-reminder-and-itinerary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the reminder and itinerary email.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Guest::where('is_attending', true)
            ->whereNotNull('email')
            ->each(function ($guest) {
                Mail::to($guest->email)->send(new ReminderAndItinerary($guest));

                $this->line('Emailed guest ' . $guest->name . ' at ' . $guest->email);
            });
    }
}
