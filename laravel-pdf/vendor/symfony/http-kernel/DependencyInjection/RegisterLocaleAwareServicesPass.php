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

use Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Register all services that have the "kernel.locale_aware" tag into the listener.
 *
 * @author Pierre Bobiet <pierrebobiet@gmail.com>
 */
class RegisterLocaleAwareServicesPass implements CompilerPassInterface
{
<<<<<<< HEAD
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('locale_aware_listener')) {
=======
    private $listenerServiceId;
    private $localeAwareTag;

    public function __construct(string $listenerServiceId = 'locale_aware_listener', string $localeAwareTag = 'kernel.locale_aware')
    {
        if (0 < \func_num_args()) {
            trigger_deprecation('symfony/http-kernel', '5.3', 'Configuring "%s" is deprecated.', __CLASS__);
        }

        $this->listenerServiceId = $listenerServiceId;
        $this->localeAwareTag = $localeAwareTag;
    }

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition($this->listenerServiceId)) {
>>>>>>> origin/New-FakeMain
            return;
        }

        $services = [];

<<<<<<< HEAD
        foreach ($container->findTaggedServiceIds('kernel.locale_aware') as $id => $tags) {
=======
        foreach ($container->findTaggedServiceIds($this->localeAwareTag) as $id => $tags) {
>>>>>>> origin/New-FakeMain
            $services[] = new Reference($id);
        }

        if (!$services) {
<<<<<<< HEAD
            $container->removeDefinition('locale_aware_listener');
=======
            $container->removeDefinition($this->listenerServiceId);
>>>>>>> origin/New-FakeMain

            return;
        }

        $container
<<<<<<< HEAD
            ->getDefinition('locale_aware_listener')
=======
            ->getDefinition($this->listenerServiceId)
>>>>>>> origin/New-FakeMain
            ->setArgument(0, new IteratorArgument($services))
        ;
    }
}
