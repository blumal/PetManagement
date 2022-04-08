<?php

namespace Illuminate\Mail\Transport;

use Aws\Exception\AwsException;
use Aws\Ses\SesClient;
<<<<<<< HEAD
use Exception;
use Symfony\Component\Mailer\Header\MetadataHeader;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Message;

class SesTransport extends AbstractTransport
=======
use Swift_Mime_SimpleMessage;
use Swift_TransportException;

class SesTransport extends Transport
>>>>>>> origin/New-FakeMain
{
    /**
     * The Amazon SES instance.
     *
     * @var \Aws\Ses\SesClient
     */
    protected $ses;

    /**
     * The Amazon SES transmission options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * Create a new SES transport instance.
     *
     * @param  \Aws\Ses\SesClient  $ses
     * @param  array  $options
     * @return void
     */
    public function __construct(SesClient $ses, $options = [])
    {
        $this->ses = $ses;
        $this->options = $options;
<<<<<<< HEAD

        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function doSend(SentMessage $message): void
    {
        $options = $this->options;

        if ($message->getOriginalMessage() instanceof Message) {
            foreach ($message->getOriginalMessage()->getHeaders()->all() as $header) {
                if ($header instanceof MetadataHeader) {
                    $options['EmailTags'][] = ['Name' => $header->getKey(), 'Value' => $header->getValue()];
                }
            }
        }
=======
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);
>>>>>>> origin/New-FakeMain

        try {
            $result = $this->ses->sendRawEmail(
                array_merge(
<<<<<<< HEAD
                    $options, [
                        'Source' => $message->getEnvelope()->getSender()->toString(),
                        'Destinations' => collect($message->getEnvelope()->getRecipients())
                                ->map
                                ->toString()
                                ->values()
                                ->all(),
=======
                    $this->options, [
                        'Source' => key($message->getSender() ?: $message->getFrom()),
>>>>>>> origin/New-FakeMain
                        'RawMessage' => [
                            'Data' => $message->toString(),
                        ],
                    ]
                )
            );
        } catch (AwsException $e) {
<<<<<<< HEAD
            throw new Exception('Request to AWS SES API failed.', $e->getCode(), $e);
=======
            throw new Swift_TransportException('Request to AWS SES API failed.', $e->getCode(), $e);
>>>>>>> origin/New-FakeMain
        }

        $messageId = $result->get('MessageId');

<<<<<<< HEAD
        $message->getOriginalMessage()->getHeaders()->addHeader('X-Message-ID', $messageId);
        $message->getOriginalMessage()->getHeaders()->addHeader('X-SES-Message-ID', $messageId);
    }

    /**
     * Get the string representation of the transport.
     *
     * @return string
     */
    public function __toString(): string
    {
        return 'ses';
=======
        $message->getHeaders()->addTextHeader('X-Message-ID', $messageId);
        $message->getHeaders()->addTextHeader('X-SES-Message-ID', $messageId);

        $this->sendPerformed($message);

        return $this->numberOfRecipients($message);
>>>>>>> origin/New-FakeMain
    }

    /**
     * Get the Amazon SES client for the SesTransport instance.
     *
     * @return \Aws\Ses\SesClient
     */
    public function ses()
    {
        return $this->ses;
    }

    /**
     * Get the transmission options being used by the transport.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the transmission options being used by the transport.
     *
     * @param  array  $options
     * @return array
     */
    public function setOptions(array $options)
    {
        return $this->options = $options;
    }
}
