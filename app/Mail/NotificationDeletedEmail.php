<?php

namespace App\Mail;

use App\CActivityLog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationDeletedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $pesan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pesan)
    {
        //
        $this->pesan = $pesan;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('rizkiakbarzein@gmail.com')->view('mail.notificationdelete')
        ->with([
            'pesan' => $this->pesan
        ]);
    }
}
