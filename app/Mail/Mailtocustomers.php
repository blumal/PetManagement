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

    public $sub;
    public $datas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('clinica/vistas/mailtocustomer')->subject($this->sub);
        /* return $this->view('clinica/vistas/mailtocustomer', compact('datas')); */
        /* return view('clinica/vistas/citas'); */
    }
}
