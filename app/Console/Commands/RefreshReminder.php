<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminders = Reminder::where('status', 1)->where('repeat', '!=', 'none')->get(); // ngambil data status reminder yang status nya completed dan repeat nya bukan none alias selain none (daily, weekly, monthly)

        foreach ($reminders as $r) {
            if (!$r->completed_at) continue;

            $aktifLagi = false;

            switch ($r->repeat) {
                case 'daily':
                    if ($r->completed_at->diffInHours(now()) >= 24) {
                        $aktifLagi = true;
                    }
                    break;

                case 'weekly':
                    if ($r->completed_at->diffInDays(now()) >= 7) {
                        $aktifLagi = true;
                    }
                    break;

                case 'monthly':
                    if ($r->completed_at->diffInDays(now()) >= 30) {
                        $aktifLagi = true;
                    }
                    break;
            }

            if ($aktifLagi) {
                $r->update([
                    'status' => 0,
                    'completed_at' => null
                ]);
            }
        }

        $this->info('Repeat reminder berhasil di refresh');
    }
}
