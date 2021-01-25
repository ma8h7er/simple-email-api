<?php

namespace App\Jobs;

use App\Mail\TestEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array of emails
     * [['recipient' => 'john@gmail.com', 'subject' => 'Email subject', 'body' => '<p>Hello</p>', 'attachments' => []]]
     */
    protected $emailsData;

    /**
     * Create a new job instance.
     *
     * @param array $emails
     */
    public function __construct(array $emails)
    {
        $this->emailsData = $emails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->emailsData as $emailItem) {
            $email = new TestEmail($emailItem['subject'], $emailItem['body'], isset($emailItem['attachments']) ? $emailItem['attachments'] : []);
            Mail::to($emailItem['recipient'])->queue($email);
        }
    }
}
