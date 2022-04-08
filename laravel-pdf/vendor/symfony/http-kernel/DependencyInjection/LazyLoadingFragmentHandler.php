<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\DependencyInjection;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
<<<<<<< HEAD
use Symfony\Component\HttpKernel\Controller\ControllerReference;
=======
>>>>>>> origin/New-FakeMain
use Symfony\Component\HttpKernel\Fragment\FragmentHandler;

/**
 * Lazily loads fragment renderers from the dependency injection container.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class LazyLoadingFragmentHandler extends FragmentHandler
{
    private $container;

    /**
     * @var array<string, bool>
     */
<<<<<<< HEAD
    private array $initialized = [];
=======
    private $initialized = [];
>>>>>>> origin/New-FakeMain

    public function __construct(ContainerInterface $container, RequestStack $requestStack, bool $debug = false)
    {
        $this->container = $container;

        parent::__construct($requestStack, [], $debug);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function render(string|ControllerReference $uri, string $renderer = 'inline', array $options = []): ?string
=======
    public function render($uri, string $renderer = 'inline', array $options = [])
>>>>>>> origin/New-FakeMain
    {
        if (!isset($this->initialized[$renderer]) && $this->container->has($renderer)) {
            $this->addRenderer($this->container->get($renderer));
            $this->initialized[$renderer] = true;
        }

        return parent::render($uri, $renderer, $options);
    }
}
