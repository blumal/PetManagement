<?php

namespace Illuminate\Mail\Events;

<<<<<<< HEAD
use Exception;
use Illuminate\Mail\SentMessage;

/**
 * @property \Symfony\Component\Mime\Email $message
 */
class MessageSent
{
    /**
     * The message that was sent.
     *
     * @var \Illuminate\Mail\SentMessage
     */
    public $sent;
=======
use Swift_Attachment;

class MessageSent
{
    /**
     * The Swift message instance.
     *
     * @var \Swift_Message
     */
    public $message;
>>>>>>> origin/New-FakeMain

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
     * @param  \Illuminate\Mail\SentMessage  $message
     * @param  array  $data
     * @return void
     */
    public function __construct(SentMessage $message, array $data = [])
    {
        $this->sent = $message;
        $this->data = $data;
=======
     * @param  \Swift_Message  $message
     * @param  array  $data
     * @return void
     */
    public function __construct($message, $data = [])
    {
        $this->data = $data;
        $this->message = $message;
>>>>>>> origin/New-FakeMain
    }

    /**
     * Get the serializable representation of the object.
     *
     * @return array
     */
    public function __serialize()
    {
<<<<<<< HEAD
        $hasAttachments = collect($this->message->getAttachments())->isNotEmpty();

        return $hasAttachments ? [
            'sent' => base64_encode(serialize($this->sent)),
            'data' => base64_encode(serialize($this->data)),
            'hasAttachments' => true,
        ] : [
            'sent' => $this->sent,
=======
        $hasAttachments = collect($this->message->getChildren())
                                ->whereInstanceOf(Swift_Attachment::class)
                                ->isNotEmpty();

        return $hasAttachments ? [
            'message' => base64_encode(serialize($this->message)),
            'data' => base64_encode(serialize($this->data)),
            'hasAttachments' => true,
        ] : [
            'message' => $this->message,
>>>>>>> origin/New-FakeMain
            'data' => $this->data,
            'hasAttachments' => false,
        ];
    }

    /**
     * Marshal the object from its serialized data.
     *
     * @param  array  $data
     * @return void
     */
    public function __unserialize(array $data)
    {
        if (isset($data['hasAttachments']) && $data['hasAttachments'] === true) {
<<<<<<< HEAD
            $this->sent = unserialize(base64_decode($data['sent']));
            $this->data = unserialize(base64_decode($data['data']));
        } else {
            $this->sent = $data['sent'];
            $this->data = $data['data'];
        }
    }

    /**
     * Dynamically get the original message.
     *
     * @param  string  $key
     * @return mixed
     *
     * @throws \Exception
     */
    public function __get($key)
    {
        if ($key === 'message') {
            return $this->sent->getOriginalMessage();
        }

        throw new Exception('Unable to access undefined property on '.__CLASS__.': '.$key);
    }
=======
            $this->message = unserialize(base64_decode($data['message']));
            $this->data = unserialize(base64_decode($data['data']));
        } else {
            $this->message = $data['message'];
            $this->data = $data['data'];
        }
    }
>>>>>>> origin/New-FakeMain
}
