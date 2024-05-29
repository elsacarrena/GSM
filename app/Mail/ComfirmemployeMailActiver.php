<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ComfirmemployeMailActiver extends Mailable
{
    use Queueable, SerializesModels;
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
        $mail = $this->markdown('mail.ComfirmemployeMailActiver',
         ['id' => $this->id,
         'nom' => $this->userName])
        ->subject('Creation de compte');

        return $mail;

    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Comfirmemploye Mail Activer',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         markdown: 'mail.ComfirmemployeMailActiver',
    //     );
    // }

}
