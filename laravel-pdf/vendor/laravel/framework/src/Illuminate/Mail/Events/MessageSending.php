<?php

namespace Illuminate\Mail\Events;

<<<<<<< HEAD
use Symfony\Component\Mime\Email;

class MessageSending
{
    /**
     * The Symfony Email instance.
     *
     * @var \Symfony\Component\Mime\Email
=======
class MessageSending
{
    /**
     * The Swift message instance.
     *
     * @var \Swift_Message
>>>>>>> origin/New-FakeMain
     */
    public $message;

    /**
     * The message data.
     *
     * @var array
     */
    public $data;

    /**
     * Create a new event instance.
     *
<<<<<<< HEAD
     * @param  \Symfony\Component\Mime\Email  $message
     * @param  array  $data
     * @return void
     */
    public function __construct(Email $message, array $data = [])
=======
     * @param  \Swift_Message  $message
     * @param  array  $data
     * @return void
     */
    public function __construct($message, $data = [])
>>>>>>> origin/New-FakeMain
    {
        $this->data = $data;
        $this->message = $message;
    }
}
