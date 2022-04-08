<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Mime\Header;

use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Exception\LogicException;

/**
 * A collection of headers.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class Headers
{
    private const UNIQUE_HEADERS = [
        'date', 'from', 'sender', 'reply-to', 'to', 'cc', 'bcc',
        'message-id', 'in-reply-to', 'references', 'subject',
    ];
    private const HEADER_CLASS_MAP = [
        'date' => DateHeader::class,
        'from' => MailboxListHeader::class,
        'sender' => MailboxHeader::class,
        'reply-to' => MailboxListHeader::class,
        'to' => MailboxListHeader::class,
        'cc' => MailboxListHeader::class,
        'bcc' => MailboxListHeader::class,
        'message-id' => IdentificationHeader::class,
        'in-reply-to' => UnstructuredHeader::class, // `In-Reply-To` and `References` are less strict than RFC 2822 (3.6.4) to allow users entering the original email's ...
        'references' => UnstructuredHeader::class, // ... `Message-ID`, even if that is no valid `msg-id`
        'return-path' => PathHeader::class,
    ];

    /**
     * @var HeaderInterface[][]
     */
<<<<<<< HEAD
    private array $headers = [];
    private int $lineLength = 76;
=======
    private $headers = [];
    private $lineLength = 76;
>>>>>>> origin/New-FakeMain

    public function __construct(HeaderInterface ...$headers)
    {
        foreach ($headers as $header) {
            $this->add($header);
        }
    }

    public function __clone()
    {
        foreach ($this->headers as $name => $collection) {
            foreach ($collection as $i => $header) {
                $this->headers[$name][$i] = clone $header;
            }
        }
    }

    public function setMaxLineLength(int $lineLength)
    {
        $this->lineLength = $lineLength;
        foreach ($this->all() as $header) {
            $header->setMaxLineLength($lineLength);
        }
    }

    public function getMaxLineLength(): int
    {
        return $this->lineLength;
    }

    /**
     * @param array<Address|string> $addresses
     *
     * @return $this
     */
<<<<<<< HEAD
    public function addMailboxListHeader(string $name, array $addresses): static
=======
    public function addMailboxListHeader(string $name, array $addresses): self
>>>>>>> origin/New-FakeMain
    {
        return $this->add(new MailboxListHeader($name, Address::createArray($addresses)));
    }

    /**
<<<<<<< HEAD
     * @return $this
     */
    public function addMailboxHeader(string $name, Address|string $address): static
=======
     * @param Address|string $address
     *
     * @return $this
     */
    public function addMailboxHeader(string $name, $address): self
>>>>>>> origin/New-FakeMain
    {
        return $this->add(new MailboxHeader($name, Address::create($address)));
    }

    /**
<<<<<<< HEAD
     * @return $this
     */
    public function addIdHeader(string $name, string|array $ids): static
=======
     * @param string|array $ids
     *
     * @return $this
     */
    public function addIdHeader(string $name, $ids): self
>>>>>>> origin/New-FakeMain
    {
        return $this->add(new IdentificationHeader($name, $ids));
    }

    /**
<<<<<<< HEAD
     * @return $this
     */
    public function addPathHeader(string $name, Address|string $path): static
=======
     * @param Address|string $path
     *
     * @return $this
     */
    public function addPathHeader(string $name, $path): self
>>>>>>> origin/New-FakeMain
    {
        return $this->add(new PathHeader($name, $path instanceof Address ? $path : new Address($path)));
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function addDateHeader(string $name, \DateTimeInterface $dateTime): static
=======
    public function addDateHeader(string $name, \DateTimeInterface $dateTime): self
>>>>>>> origin/New-FakeMain
    {
        return $this->add(new DateHeader($name, $dateTime));
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function addTextHeader(string $name, string $value): static
=======
    public function addTextHeader(string $name, string $value): self
>>>>>>> origin/New-FakeMain
    {
        return $this->add(new UnstructuredHeader($name, $value));
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function addParameterizedHeader(string $name, string $value, array $params = []): static
=======
    public function addParameterizedHeader(string $name, string $value, array $params = []): self
>>>>>>> origin/New-FakeMain
    {
        return $this->add(new ParameterizedHeader($name, $value, $params));
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function addHeader(string $name, mixed $argument, array $more = []): static
=======
    public function addHeader(string $name, $argument, array $more = []): self
>>>>>>> origin/New-FakeMain
    {
        $parts = explode('\\', self::HEADER_CLASS_MAP[strtolower($name)] ?? UnstructuredHeader::class);
        $method = 'add'.ucfirst(array_pop($parts));
        if ('addUnstructuredHeader' === $method) {
            $method = 'addTextHeader';
        } elseif ('addIdentificationHeader' === $method) {
            $method = 'addIdHeader';
        }

        return $this->$method($name, $argument, $more);
    }

    public function has(string $name): bool
    {
        return isset($this->headers[strtolower($name)]);
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function add(HeaderInterface $header): static
=======
    public function add(HeaderInterface $header): self
>>>>>>> origin/New-FakeMain
    {
        self::checkHeaderClass($header);

        $header->setMaxLineLength($this->lineLength);
        $name = strtolower($header->getName());

        if (\in_array($name, self::UNIQUE_HEADERS, true) && isset($this->headers[$name]) && \count($this->headers[$name]) > 0) {
            throw new LogicException(sprintf('Impossible to set header "%s" as it\'s already defined and must be unique.', $header->getName()));
        }

        $this->headers[$name][] = $header;

        return $this;
    }

    public function get(string $name): ?HeaderInterface
    {
        $name = strtolower($name);
        if (!isset($this->headers[$name])) {
            return null;
        }

        $values = array_values($this->headers[$name]);

        return array_shift($values);
    }

    public function all(string $name = null): iterable
    {
        if (null === $name) {
            foreach ($this->headers as $name => $collection) {
                foreach ($collection as $header) {
                    yield $name => $header;
                }
            }
        } elseif (isset($this->headers[strtolower($name)])) {
            foreach ($this->headers[strtolower($name)] as $header) {
                yield $header;
            }
        }
    }

    public function getNames(): array
    {
        return array_keys($this->headers);
    }

    public function remove(string $name): void
    {
        unset($this->headers[strtolower($name)]);
    }

    public static function isUniqueHeader(string $name): bool
    {
        return \in_array(strtolower($name), self::UNIQUE_HEADERS, true);
    }

    /**
     * @throws LogicException if the header name and class are not compatible
     */
    public static function checkHeaderClass(HeaderInterface $header): void
    {
        $name = strtolower($header->getName());

        if (($c = self::HEADER_CLASS_MAP[$name] ?? null) && !$header instanceof $c) {
            throw new LogicException(sprintf('The "%s" header must be an instance of "%s" (got "%s").', $header->getName(), $c, get_debug_type($header)));
        }
    }

    public function toString(): string
    {
        $string = '';
        foreach ($this->toArray() as $str) {
            $string .= $str."\r\n";
        }

        return $string;
    }

    public function toArray(): array
    {
        $arr = [];
        foreach ($this->all() as $header) {
            if ('' !== $header->getBodyAsString()) {
                $arr[] = $header->toString();
            }
        }

        return $arr;
    }

<<<<<<< HEAD
=======
    /**
     * @internal
     */
>>>>>>> origin/New-FakeMain
    public function getHeaderBody(string $name)
    {
        return $this->has($name) ? $this->get($name)->getBody() : null;
    }

    /**
     * @internal
     */
<<<<<<< HEAD
    public function setHeaderBody(string $type, string $name, mixed $body): void
=======
    public function setHeaderBody(string $type, string $name, $body): void
>>>>>>> origin/New-FakeMain
    {
        if ($this->has($name)) {
            $this->get($name)->setBody($body);
        } else {
            $this->{'add'.$type.'Header'}($name, $body);
        }
    }

    public function getHeaderParameter(string $name, string $parameter): ?string
    {
        if (!$this->has($name)) {
            return null;
        }

        $header = $this->get($name);
        if (!$header instanceof ParameterizedHeader) {
            throw new LogicException(sprintf('Unable to get parameter "%s" on header "%s" as the header is not of class "%s".', $parameter, $name, ParameterizedHeader::class));
        }

        return $header->getParameter($parameter);
    }

    /**
     * @internal
     */
    public function setHeaderParameter(string $name, string $parameter, ?string $value): void
    {
        if (!$this->has($name)) {
            throw new LogicException(sprintf('Unable to set parameter "%s" on header "%s" as the header is not defined.', $parameter, $name));
        }

        $header = $this->get($name);
        if (!$header instanceof ParameterizedHeader) {
            throw new LogicException(sprintf('Unable to set parameter "%s" on header "%s" as the header is not of class "%s".', $parameter, $name, ParameterizedHeader::class));
        }

        $header->setParameter($parameter, $value);
    }
}
