<?php

namespace App\Mail;

use App\Http\Controllers\CitasController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailtocustomers extends Mailable
{
    use Queueable, SerializesModels;

    public $maildatas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($maildatas)
    {
        $this->maildatas = $maildatas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('clinica/vistas/mailtocustomer');
        /* return view('clinica/vistas/citas'); */
    }
}
