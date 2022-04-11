<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\Test;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\Translation\Dumper\XliffFileDumper;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\Provider\ProviderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * A test case to ease testing a translation provider.
 *
 * @author Mathieu Santostefano <msantostefano@protonmail.com>
 *
 * @internal
 */
abstract class ProviderTestCase extends TestCase
{
    protected $client;
    protected $logger;
<<<<<<< HEAD
    protected string $defaultLocale;
=======
    protected $defaultLocale;
>>>>>>> origin/New-FakeMain
    protected $loader;
    protected $xliffFileDumper;

    abstract public function createProvider(HttpClientInterface $client, LoaderInterface $loader, LoggerInterface $logger, string $defaultLocale, string $endpoint): ProviderInterface;

    /**
     * @return iterable<array{0: string, 1: ProviderInterface}>
     */
    abstract public function toStringProvider(): iterable;

    /**
     * @dataProvider toStringProvider
     */
    public function testToString(ProviderInterface $provider, string $expected)
    {
        $this->assertSame($expected, (string) $provider);
    }

    protected function getClient(): MockHttpClient
    {
<<<<<<< HEAD
        return $this->client ??= new MockHttpClient();
=======
        return $this->client ?? $this->client = new MockHttpClient();
>>>>>>> origin/New-FakeMain
    }

    protected function getLoader(): LoaderInterface
    {
<<<<<<< HEAD
        return $this->loader ??= $this->createMock(LoaderInterface::class);
=======
        return $this->loader ?? $this->loader = $this->createMock(LoaderInterface::class);
>>>>>>> origin/New-FakeMain
    }

    protected function getLogger(): LoggerInterface
    {
<<<<<<< HEAD
        return $this->logger ??= $this->createMock(LoggerInterface::class);
=======
        return $this->logger ?? $this->logger = $this->createMock(LoggerInterface::class);
>>>>>>> origin/New-FakeMain
    }

    protected function getDefaultLocale(): string
    {
<<<<<<< HEAD
        return $this->defaultLocale ??= 'en';
=======
        return $this->defaultLocale ?? $this->defaultLocale = 'en';
>>>>>>> origin/New-FakeMain
    }

    protected function getXliffFileDumper(): XliffFileDumper
    {
<<<<<<< HEAD
        return $this->xliffFileDumper ??= $this->createMock(XliffFileDumper::class);
=======
        return $this->xliffFileDumper ?? $this->xliffFileDumper = $this->createMock(XliffFileDumper::class);
>>>>>>> origin/New-FakeMain
    }
}
