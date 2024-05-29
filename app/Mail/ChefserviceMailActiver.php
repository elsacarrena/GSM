<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChefserviceMailActiver extends Mailable
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

   /**
    * The build function generates an email using a markdown template for account confirmation.
    *
    *  `build` function is returning an email message that is built using Markdown template
    * `mail.ChefserviceMailActiver` with the provided data `id` and `nom`. The subject of the email is
    * set to 'Confirmation de compte'.
    */
    //     public function build()
    // {
    //     $mail = $this->markdown('mail.ChefserviceMailActiver',
    //      ['id' => $this->id,
    //      'nom' => $this->userName])
    //     ->subject('Confirmation de compte');

    //     return $mail;

    // }



    public function build()
    {
        return $this->view('mail.ChefserviceMailActiver')
                    ->with([
                        'userName' => $this->userName,
                        'id' => $this->id,
                    ]);
    }
}
