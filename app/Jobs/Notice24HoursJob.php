<?php

namespace App\Jobs;

use App\Mail\Notice24Hours;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class Notice24HoursJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sendTo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($sendTo)
    {
        $this->sendTo = $sendTo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->sendTo)->send(new Notice24Hours());
    }
}
