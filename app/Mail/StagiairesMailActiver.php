<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class StagiairesMailActiver extends Mailable
{
    use Queueable, SerializesModels;
public $id;
public $userName;
    /**
     * Create a new message instance.
     */
    public function __construct($id, $userName)
    {
        $this->id = $id;
        $this->userName = $userName;
    }

        public function build()
    {
        $mail = $this->markdown('mail.stagiairesMailActiver',
         ['id' => $this->id,
         'nom' => $this->userName])
        ->subject('Confirmation de compte');

        return $mail;

    }

}
