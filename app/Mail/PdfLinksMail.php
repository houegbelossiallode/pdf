<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PdfLinksMail extends Mailable
{
use Queueable, SerializesModels;

public $pdfLinks;
public $user;

public function __construct($pdfLinks,$user)
{
$this->pdfLinks = $pdfLinks;
$this->user = $user;
}

/**
* Build the message.
*
* @return $this
*/
public function build()
{
return $this->view('emails.pdf_links')
->subject('Vos liens de téléchargement PDF')
->with(['pdfLinks'=> $this->pdfLinks, 'user'=>$this->user]);
}
}