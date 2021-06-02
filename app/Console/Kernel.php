<?php

namespace App\Console;

use App\Employee;
use App\Jobs\Notice24HoursJob;
use App\Status;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function (){
            $tasks = \App\Task::where('deadline', '<' , \Carbon\Carbon::now()
                ->addHours(24))
                ->where("notification_sent", false)
                ->whereNotNull('assigned_to')
                ->get();
            foreach ($tasks as $task) {
                $emp = Employee::find($task->assigned_to);
                Notice24HoursJob::dispatch($emp->email);
                $task->notification_sent = true;
                $task->save();
            }
        })->everyMinute();
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
