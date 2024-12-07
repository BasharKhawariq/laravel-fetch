<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\RandomUser;

class FetchRandomUser extends Command
{
    protected $signature = 'fetch:random-user';
    protected $description = 'Fetch random users from API and save to database';

    public function handle()
    {
        $this->info('Fetching random user...');
        $response = Http::get('https://randomuser.me/api/?results=10'); // Ambil 10 data
        if ($response->successful()) {
            $this->info('Data successfully fetched.');
            // Proses penyimpanan data ke database
        } else {
            $this->error('Failed to fetch data.');
        }
        if ($response->ok()) {
            $users = $response->json()['results'];
            foreach ($users as $user) {
                RandomUser::updateOrCreate(
                    ['email' => $user['email']],
                    [
                        'name' => $user['name']['first'] . ' ' . $user['name']['last'],
                        'gender' => $user['gender'],
                        'dob' => $user['dob']['date'],
                        'phone' => $user['phone'],
                        'job' => null, // Tambahkan logika jika ada pekerjaan
                        'last_updated' => now(),
                        'is_edited' => false,
                    ]
                );
            }
            $this->info('Saving user: ' . $user['email']);
        } else {
            $this->error('Failed to fetch data from API');
        }
    }
}

