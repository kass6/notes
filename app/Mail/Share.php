<?php

namespace App\Mail;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Share extends Mailable
{
    use Queueable, SerializesModels;

    public $noteId;

    /**
     * Create a new message instance.
     *
     * @param string $note
     */
    public function __construct(string $noteId)
    {
        $this->noteId = $noteId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.share');
    }
}
