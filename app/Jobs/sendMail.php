<?php

namespace App\Jobs;

use App\Mail\contractMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class sendMail implements ShouldQueue
{
    use Queueable;

    protected $email;
    protected $id;
    /**
     * Create a new job instance.
     */
    public function __construct($email, $id)
    {
        $this->email = $email;
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new contractMail($this->id));
    }
}
