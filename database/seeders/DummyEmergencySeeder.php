<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmergencyCall;
use App\Models\User;

class DummyEmergencySeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        if ($user) {
            EmergencyCall::create([
                'user_id' => $user->id,
                'location' => '-6.200000, 106.816666',
                'latitude' => '-6.200000',
                'longitude' => '106.816666',
                'description' => 'TESTING: Kecelakaan Simulasi (Untuk Cek Tombol)',
                'status' => 'pending'
            ]);
            $this->command->info('Dummy Emergency Call Created!');
        } else {
            $this->command->error('No users found in database.');
        }
    }
}
