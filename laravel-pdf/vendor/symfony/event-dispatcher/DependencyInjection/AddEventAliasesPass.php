<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * This pass allows bundles to extend the list of event aliases.
 *
 * @author Alexander M. Turek <me@derrabus.de>
 */
class AddEventAliasesPass implements CompilerPassInterface
{
<<<<<<< HEAD
    private array $eventAliases;

    public function __construct(array $eventAliases)
    {
        $this->eventAliases = $eventAliases;
=======
    private $eventAliases;
    private $eventAliasesParameter;

    public function __construct(array $eventAliases, string $eventAliasesParameter = 'event_dispatcher.event_aliases')
    {
        if (1 < \func_num_args()) {
            trigger_deprecation('symfony/event-dispatcher', '5.3', 'Configuring "%s" is deprecated.', __CLASS__);
        }

        $this->eventAliases = $eventAliases;
        $this->eventAliasesParameter = $eventAliasesParameter;
>>>>>>> origin/New-FakeMain
    }

    public function process(ContainerBuilder $container): void
    {
<<<<<<< HEAD
        $eventAliases = $container->hasParameter('event_dispatcher.event_aliases') ? $container->getParameter('event_dispatcher.event_aliases') : [];

        $container->setParameter(
            'event_dispatcher.event_aliases',
=======
        $eventAliases = $container->hasParameter($this->eventAliasesParameter) ? $container->getParameter($this->eventAliasesParameter) : [];

        $container->setParameter(
            $this->eventAliasesParameter,
>>>>>>> origin/New-FakeMain
            array_merge($eventAliases, $this->eventAliases)
        );
    }
}
