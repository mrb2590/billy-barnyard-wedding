<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $user = User::factory()->create([
            'first_name' => 'Mike',
            'last_name' => 'Buonomo',
            'email' => 'mike@buonomo.net'
        ]);

        print "\r\n\tAPI Test Token: ";
        print $user->createToken('Test')->plainTextToken;
        print "\r\n\r\n";
    }
}
