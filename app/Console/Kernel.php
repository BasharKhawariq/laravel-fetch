<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Jadwal command untuk mengambil data random user setiap 15 menit
        $schedule->command('fetch:random-user')->everyFifteenMinutes();
        // Contoh tambahan: Membersihkan log Laravel setiap hari
        $schedule->command('log:clear')->daily();

        // Tambahkan jadwal lainnya jika diperlukan
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected $commands = [
        Commands\FetchRandomUser::class,
    ];
}
