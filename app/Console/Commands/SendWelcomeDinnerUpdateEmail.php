<?php

namespace App\Console\Commands;

use App\Mail\WelcomeDinnerUpdate;
use App\Models\Guest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWelcomeDinnerUpdateEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-welcome-dinner-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the welcome dinner update email.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Guest::where('is_attending_rehearsal', true)
            ->whereNotNull('email')
            ->each(function ($guest) {
                Mail::to($guest->email)->send(new WelcomeDinnerUpdate($guest));

                $this->line('Emailed guest ' . $guest->name . ' at ' . $guest->email);
            });
    }
}
