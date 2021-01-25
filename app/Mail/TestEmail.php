<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    private $files;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $body
     * @param $attachments
     */
    public function __construct(string $subject, string $body, array $attachments)
    {
        $this->subject = $subject;
        $this->html = $body;
        $this->files = $attachments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->html($this->html)->subject($this->subject);
        foreach ($this->files as $attachment) {
            $file_64 = $attachment['file'];

            //extract file type
            $file_type = explode(':', substr($file_64, 0, strpos($file_64, ';')))[1];

            // extract file base64
            $replace = substr($file_64, 0, strpos($file_64, ',')+1);
            $file = str_replace($replace, '', $file_64);

            $email->attachData(base64_decode($file), $attachment['name'], ['mimi' => $file_type]);
        }
        return $email;
    }
}
