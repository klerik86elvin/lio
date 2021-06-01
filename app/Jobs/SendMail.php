<?php

namespace App\Jobs;

use App\Mail\AssignedToMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $assignedTo;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($assignedTo, $message)
    {
        $this->assignedTo = $assignedTo;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->assignedTo)->send(new AssignedToMessage($this->message));
//        info($this->message);
    }
}
