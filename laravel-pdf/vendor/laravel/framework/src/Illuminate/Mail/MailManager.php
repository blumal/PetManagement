<?php

namespace Illuminate\Mail;

use Aws\Ses\SesClient;
use Closure;
<<<<<<< HEAD
=======
use GuzzleHttp\Client as HttpClient;
>>>>>>> origin/New-FakeMain
use Illuminate\Contracts\Mail\Factory as FactoryContract;
use Illuminate\Log\LogManager;
use Illuminate\Mail\Transport\ArrayTransport;
use Illuminate\Mail\Transport\LogTransport;
<<<<<<< HEAD
=======
use Illuminate\Mail\Transport\MailgunTransport;
>>>>>>> origin/New-FakeMain
use Illuminate\Mail\Transport\SesTransport;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use InvalidArgumentException;
<<<<<<< HEAD
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\Bridge\Mailgun\Transport\MailgunTransportFactory;
use Symfony\Component\Mailer\Bridge\Postmark\Transport\PostmarkTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;
use Symfony\Component\Mailer\Transport\FailoverTransport;
use Symfony\Component\Mailer\Transport\SendmailTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransportFactory;
use Symfony\Component\Mailer\Transport\Smtp\Stream\SocketStream;
=======
use Postmark\ThrowExceptionOnFailurePlugin;
use Postmark\Transport as PostmarkTransport;
use Psr\Log\LoggerInterface;
use Swift_DependencyContainer;
use Swift_FailoverTransport as FailoverTransport;
use Swift_Mailer;
use Swift_SendmailTransport as SendmailTransport;
use Swift_SmtpTransport as SmtpTransport;
>>>>>>> origin/New-FakeMain

/**
 * @mixin \Illuminate\Mail\Mailer
 */
class MailManager implements FactoryContract
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * The array of resolved mailers.
     *
     * @var array
     */
    protected $mailers = [];

    /**
     * The registered custom driver creators.
     *
     * @var array
     */
    protected $customCreators = [];

    /**
     * Create a new Mail manager instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get a mailer instance by name.
     *
     * @param  string|null  $name
     * @return \Illuminate\Contracts\Mail\Mailer
     */
    public function mailer($name = null)
    {
        $name = $name ?: $this->getDefaultDriver();

        return $this->mailers[$name] = $this->get($name);
    }

    /**
     * Get a mailer driver instance.
     *
     * @param  string|null  $driver
     * @return \Illuminate\Mail\Mailer
     */
    public function driver($driver = null)
    {
        return $this->mailer($driver);
    }

    /**
     * Attempt to get the mailer from the local cache.
     *
     * @param  string  $name
     * @return \Illuminate\Mail\Mailer
     */
    protected function get($name)
    {
        return $this->mailers[$name] ?? $this->resolve($name);
    }

    /**
     * Resolve the given mailer.
     *
     * @param  string  $name
     * @return \Illuminate\Mail\Mailer
     *
     * @throws \InvalidArgumentException
     */
    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        if (is_null($config)) {
            throw new InvalidArgumentException("Mailer [{$name}] is not defined.");
        }

        // Once we have created the mailer instance we will set a container instance
        // on the mailer. This allows us to resolve mailer classes via containers
        // for maximum testability on said classes instead of passing Closures.
        $mailer = new Mailer(
            $name,
            $this->app['view'],
<<<<<<< HEAD
            $this->createSymfonyTransport($config),
=======
            $this->createSwiftMailer($config),
>>>>>>> origin/New-FakeMain
            $this->app['events']
        );

        if ($this->app->bound('queue')) {
            $mailer->setQueue($this->app['queue']);
        }

        // Next we will set all of the global addresses on this mailer, which allows
        // for easy unification of all "from" addresses as well as easy debugging
        // of sent messages since these will be sent to a single email address.
        foreach (['from', 'reply_to', 'to', 'return_path'] as $type) {
            $this->setGlobalAddress($mailer, $config, $type);
        }

        return $mailer;
    }

    /**
<<<<<<< HEAD
     * Create a new transport instance.
     *
     * @param  array  $config
     * @return \Symfony\Component\Mailer\Transport\TransportInterface
     *
     * @throws \InvalidArgumentException
     */
    public function createSymfonyTransport(array $config)
=======
     * Create the SwiftMailer instance for the given configuration.
     *
     * @param  array  $config
     * @return \Swift_Mailer
     */
    protected function createSwiftMailer(array $config)
    {
        if ($config['domain'] ?? false) {
            Swift_DependencyContainer::getInstance()
                ->register('mime.idgenerator.idright')
                ->asValue($config['domain']);
        }

        return new Swift_Mailer($this->createTransport($config));
    }

    /**
     * Create a new transport instance.
     *
     * @param  array  $config
     * @return \Swift_Transport
     *
     * @throws \InvalidArgumentException
     */
    public function createTransport(array $config)
>>>>>>> origin/New-FakeMain
    {
        // Here we will check if the "transport" key exists and if it doesn't we will
        // assume an application is still using the legacy mail configuration file
        // format and use the "mail.driver" configuration option instead for BC.
        $transport = $config['transport'] ?? $this->app['config']['mail.driver'];

        if (isset($this->customCreators[$transport])) {
            return call_user_func($this->customCreators[$transport], $config);
        }

        if (trim($transport ?? '') === '' || ! method_exists($this, $method = 'create'.ucfirst($transport).'Transport')) {
            throw new InvalidArgumentException("Unsupported mail transport [{$transport}].");
        }

        return $this->{$method}($config);
    }

    /**
<<<<<<< HEAD
     * Create an instance of the Symfony SMTP Transport driver.
     *
     * @param  array  $config
     * @return \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport
     */
    protected function createSmtpTransport(array $config)
    {
        $factory = new EsmtpTransportFactory;

        $transport = $factory->create(new Dsn(
            ! empty($config['encryption']) && $config['encryption'] === 'tls' ? (($config['port'] == 465) ? 'smtps' : 'smtp') : '',
            $config['host'],
            $config['username'] ?? null,
            $config['password'] ?? null,
            $config['port'] ?? null,
            $config
        ));
=======
     * Create an instance of the SMTP Swift Transport driver.
     *
     * @param  array  $config
     * @return \Swift_SmtpTransport
     */
    protected function createSmtpTransport(array $config)
    {
        // The Swift SMTP transport instance will allow us to use any SMTP backend
        // for delivering mail such as Sendgrid, Amazon SES, or a custom server
        // a developer has available. We will just pass this configured host.
        $transport = new SmtpTransport(
            $config['host'],
            $config['port']
        );

        if (! empty($config['encryption'])) {
            $transport->setEncryption($config['encryption']);
        }

        // Once we have the transport we will check for the presence of a username
        // and password. If we have it we will set the credentials on the Swift
        // transporter instance so that we'll properly authenticate delivery.
        if (isset($config['username'])) {
            $transport->setUsername($config['username']);

            $transport->setPassword($config['password']);
        }
>>>>>>> origin/New-FakeMain

        return $this->configureSmtpTransport($transport, $config);
    }

    /**
     * Configure the additional SMTP driver options.
     *
<<<<<<< HEAD
     * @param  \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport  $transport
     * @param  array  $config
     * @return \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport
     */
    protected function configureSmtpTransport(EsmtpTransport $transport, array $config)
    {
        $stream = $transport->getStream();

        if ($stream instanceof SocketStream) {
            if (isset($config['source_ip'])) {
                $stream->setSourceIp($config['source_ip']);
            }

            if (isset($config['timeout'])) {
                $stream->setTimeout($config['timeout']);
            }
=======
     * @param  \Swift_SmtpTransport  $transport
     * @param  array  $config
     * @return \Swift_SmtpTransport
     */
    protected function configureSmtpTransport($transport, array $config)
    {
        if (isset($config['stream'])) {
            $transport->setStreamOptions($config['stream']);
        }

        if (isset($config['source_ip'])) {
            $transport->setSourceIp($config['source_ip']);
        }

        if (isset($config['local_domain'])) {
            $transport->setLocalDomain($config['local_domain']);
        }

        if (isset($config['timeout'])) {
            $transport->setTimeout($config['timeout']);
        }

        if (isset($config['auth_mode'])) {
            $transport->setAuthMode($config['auth_mode']);
>>>>>>> origin/New-FakeMain
        }

        return $transport;
    }

    /**
<<<<<<< HEAD
     * Create an instance of the Symfony Sendmail Transport driver.
     *
     * @param  array  $config
     * @return \Symfony\Component\Mailer\Transport\SendmailTransport
=======
     * Create an instance of the Sendmail Swift Transport driver.
     *
     * @param  array  $config
     * @return \Swift_SendmailTransport
>>>>>>> origin/New-FakeMain
     */
    protected function createSendmailTransport(array $config)
    {
        return new SendmailTransport(
            $config['path'] ?? $this->app['config']->get('mail.sendmail')
        );
    }

    /**
<<<<<<< HEAD
     * Create an instance of the Symfony Amazon SES Transport driver.
     *
     * @param  array  $config
     * @return \Symfony\Component\Mailer\Bridge\Amazon\Transport\SesApiAsyncAwsTransport
=======
     * Create an instance of the Amazon SES Swift Transport driver.
     *
     * @param  array  $config
     * @return \Illuminate\Mail\Transport\SesTransport
>>>>>>> origin/New-FakeMain
     */
    protected function createSesTransport(array $config)
    {
        $config = array_merge(
            $this->app['config']->get('services.ses', []),
            ['version' => 'latest', 'service' => 'email'],
            $config
        );

        $config = Arr::except($config, ['transport']);

        return new SesTransport(
            new SesClient($this->addSesCredentials($config)),
            $config['options'] ?? []
        );
    }

    /**
     * Add the SES credentials to the configuration array.
     *
     * @param  array  $config
     * @return array
     */
    protected function addSesCredentials(array $config)
    {
        if (! empty($config['key']) && ! empty($config['secret'])) {
            $config['credentials'] = Arr::only($config, ['key', 'secret', 'token']);
        }

        return $config;
    }

    /**
<<<<<<< HEAD
     * Create an instance of the Symfony Mail Transport driver.
     *
     * @return \Symfony\Component\Mailer\Transport\SendmailTransport
=======
     * Create an instance of the Mail Swift Transport driver.
     *
     * @return \Swift_SendmailTransport
>>>>>>> origin/New-FakeMain
     */
    protected function createMailTransport()
    {
        return new SendmailTransport;
    }

    /**
<<<<<<< HEAD
     * Create an instance of the Symfony Mailgun Transport driver.
     *
     * @param  array  $config
     * @return \Symfony\Component\Mailer\Bridge\Mailgun\Transport\MailgunApiTransport
     */
    protected function createMailgunTransport(array $config)
    {
        $factory = new MailgunTransportFactory();

=======
     * Create an instance of the Mailgun Swift Transport driver.
     *
     * @param  array  $config
     * @return \Illuminate\Mail\Transport\MailgunTransport
     */
    protected function createMailgunTransport(array $config)
    {
>>>>>>> origin/New-FakeMain
        if (! isset($config['secret'])) {
            $config = $this->app['config']->get('services.mailgun', []);
        }

<<<<<<< HEAD
        return $factory->create(new Dsn(
            'mailgun+'.($config['scheme'] ?? 'https'),
            $config['endpoint'] ?? 'default',
            $config['secret'],
            $config['domain']
        ));
    }

    /**
     * Create an instance of the Symfony Postmark Transport driver.
     *
     * @param  array  $config
     * @return \Symfony\Component\Mailer\Bridge\Postmark\Transport\PostmarkApiTransport
     */
    protected function createPostmarkTransport(array $config)
    {
        $factory = new PostmarkTransportFactory();

        $options = isset($config['message_stream_id'])
                    ? ['message_stream' => $config['message_stream_id']]
                    : [];

        return $factory->create(new Dsn(
            'postmark+api',
            'default',
            $config['token'] ?? $this->app['config']->get('services.postmark.token'),
            null,
            null,
            $options
        ));
    }

    /**
     * Create an instance of the Symfony Failover Transport driver.
     *
     * @param  array  $config
     * @return \Symfony\Component\Mailer\Transport\FailoverTransport
=======
        return new MailgunTransport(
            $this->guzzle($config),
            $config['secret'],
            $config['domain'],
            $config['endpoint'] ?? null
        );
    }

    /**
     * Create an instance of the Postmark Swift Transport driver.
     *
     * @param  array  $config
     * @return \Swift_Transport
     */
    protected function createPostmarkTransport(array $config)
    {
        $headers = isset($config['message_stream_id']) ? [
            'X-PM-Message-Stream' => $config['message_stream_id'],
        ] : [];

        return tap(new PostmarkTransport(
            $config['token'] ?? $this->app['config']->get('services.postmark.token'),
            $headers
        ), function ($transport) {
            $transport->registerPlugin(new ThrowExceptionOnFailurePlugin);
        });
    }

    /**
     * Create an instance of the Failover Swift Transport driver.
     *
     * @param  array  $config
     * @return \Swift_FailoverTransport
>>>>>>> origin/New-FakeMain
     */
    protected function createFailoverTransport(array $config)
    {
        $transports = [];

        foreach ($config['mailers'] as $name) {
            $config = $this->getConfig($name);

            if (is_null($config)) {
                throw new InvalidArgumentException("Mailer [{$name}] is not defined.");
            }

            // Now, we will check if the "driver" key exists and if it does we will set
            // the transport configuration parameter in order to offer compatibility
            // with any Laravel <= 6.x application style mail configuration files.
            $transports[] = $this->app['config']['mail.driver']
<<<<<<< HEAD
                ? $this->createSymfonyTransport(array_merge($config, ['transport' => $name]))
                : $this->createSymfonyTransport($config);
=======
                ? $this->createTransport(array_merge($config, ['transport' => $name]))
                : $this->createTransport($config);
>>>>>>> origin/New-FakeMain
        }

        return new FailoverTransport($transports);
    }

    /**
<<<<<<< HEAD
     * Create an instance of the Log Transport driver.
=======
     * Create an instance of the Log Swift Transport driver.
>>>>>>> origin/New-FakeMain
     *
     * @param  array  $config
     * @return \Illuminate\Mail\Transport\LogTransport
     */
    protected function createLogTransport(array $config)
    {
        $logger = $this->app->make(LoggerInterface::class);

        if ($logger instanceof LogManager) {
            $logger = $logger->channel(
                $config['channel'] ?? $this->app['config']->get('mail.log_channel')
            );
        }

        return new LogTransport($logger);
    }

    /**
<<<<<<< HEAD
     * Create an instance of the Array Transport Driver.
=======
     * Create an instance of the Array Swift Transport Driver.
>>>>>>> origin/New-FakeMain
     *
     * @return \Illuminate\Mail\Transport\ArrayTransport
     */
    protected function createArrayTransport()
    {
        return new ArrayTransport;
    }

    /**
<<<<<<< HEAD
=======
     * Get a fresh Guzzle HTTP client instance.
     *
     * @param  array  $config
     * @return \GuzzleHttp\Client
     */
    protected function guzzle(array $config)
    {
        return new HttpClient(Arr::add(
            $config['guzzle'] ?? [],
            'connect_timeout',
            60
        ));
    }

    /**
>>>>>>> origin/New-FakeMain
     * Set a global address on the mailer by type.
     *
     * @param  \Illuminate\Mail\Mailer  $mailer
     * @param  array  $config
     * @param  string  $type
     * @return void
     */
    protected function setGlobalAddress($mailer, array $config, string $type)
    {
        $address = Arr::get($config, $type, $this->app['config']['mail.'.$type]);

        if (is_array($address) && isset($address['address'])) {
            $mailer->{'always'.Str::studly($type)}($address['address'], $address['name']);
        }
    }

    /**
     * Get the mail connection configuration.
     *
     * @param  string  $name
     * @return array
     */
    protected function getConfig(string $name)
    {
        // Here we will check if the "driver" key exists and if it does we will use
        // the entire mail configuration file as the "driver" config in order to
        // provide "BC" for any Laravel <= 6.x style mail configuration files.
        return $this->app['config']['mail.driver']
            ? $this->app['config']['mail']
            : $this->app['config']["mail.mailers.{$name}"];
    }

    /**
     * Get the default mail driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        // Here we will check if the "driver" key exists and if it does we will use
        // that as the default driver in order to provide support for old styles
        // of the Laravel mail configuration file for backwards compatibility.
        return $this->app['config']['mail.driver'] ??
            $this->app['config']['mail.default'];
    }

    /**
     * Set the default mail driver name.
     *
     * @param  string  $name
     * @return void
     */
    public function setDefaultDriver(string $name)
    {
        if ($this->app['config']['mail.driver']) {
            $this->app['config']['mail.driver'] = $name;
        }

        $this->app['config']['mail.default'] = $name;
    }

    /**
     * Disconnect the given mailer and remove from local cache.
     *
     * @param  string|null  $name
     * @return void
     */
    public function purge($name = null)
    {
        $name = $name ?: $this->getDefaultDriver();

        unset($this->mailers[$name]);
    }

    /**
     * Register a custom transport creator Closure.
     *
     * @param  string  $driver
     * @param  \Closure  $callback
     * @return $this
     */
    public function extend($driver, Closure $callback)
    {
        $this->customCreators[$driver] = $callback;

        return $this;
    }

    /**
     * Get the application instance used by the manager.
     *
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function getApplication()
    {
        return $this->app;
    }

    /**
     * Set the application instance used by the manager.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return $this
     */
    public function setApplication($app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Forget all of the resolved mailer instances.
     *
     * @return $this
     */
    public function forgetMailers()
    {
        $this->mailers = [];

        return $this;
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->mailer()->$method(...$parameters);
    }
}
