<?php

namespace App\Console\Commands;

use App\Models\Party;
use Illuminate\Console\Command;

class ImportGuests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guest:import-csv {filePath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import guests from a CSV';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $handle = fopen($this->argument('filePath'), 'r');

        if ($handle === false) {
            $this->error('Cannot open file ' . $this->argument('filePath'));

            return 1;
        }

        if (fgets($handle, 4) !== "\xef\xbb\xbf") {
            rewind($handle);
        }

        $columns = array_flip(array_map(fn($col) => trim($col), fgetcsv($handle)));

        while ($row = fgetcsv($handle)) {
            $address = trim($row[$columns['party_address']]) ?: null;

            $party = Party::where('address', $address)->firstOrCreate([
                'name' => trim($row[$columns['party_name']]) ?: null,
                'address' => $address,
                'message_to_party' => trim($row[$columns['party_message_to_party']]) ?: null,
                'notes' => trim($row[$columns['party_notes']]) ?: null
            ]);

            $guest = $party->guests()->create([
                'first_name' => trim($row[$columns['first_name']]) ?: null,
                'last_name' => trim($row[$columns['last_name']]) ?: null,
                'email' => trim($row[$columns['email']]) ?: null,
                'has_rehearsal_invite' => (bool) (trim($row[$columns['has_rehearsal_invite']]) ?: false),
                'is_child' => (bool) (trim($row[$columns['is_child']]) ?: false),
                'is_guest' => (bool) (trim($row[$columns['is_guest']]) ?: false),
                'message_to_guest' => trim($row[$columns['message_to_guest']]) ?: null,
                'notes' => trim($row[$columns['notes']]) ?: null,
                'side' => trim($row[$columns['side']]) ?: null,
                'relation' => trim($row[$columns['relation']]) ?: null
            ]);

            $this->line('Created guest ' . $guest->name . ' in party ' . $party->name);
        }
    }
}
