<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\DependencyInjection;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LazyCommand;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\ServiceLocatorTagPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\TypedReference;

/**
 * Registers console commands.
 *
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class AddConsoleCommandPass implements CompilerPassInterface
{
<<<<<<< HEAD
    public function process(ContainerBuilder $container)
    {
        $commandServices = $container->findTaggedServiceIds('console.command', true);
=======
    private $commandLoaderServiceId;
    private $commandTag;
    private $noPreloadTag;
    private $privateTagName;

    public function __construct(string $commandLoaderServiceId = 'console.command_loader', string $commandTag = 'console.command', string $noPreloadTag = 'container.no_preload', string $privateTagName = 'container.private')
    {
        if (0 < \func_num_args()) {
            trigger_deprecation('symfony/console', '5.3', 'Configuring "%s" is deprecated.', __CLASS__);
        }

        $this->commandLoaderServiceId = $commandLoaderServiceId;
        $this->commandTag = $commandTag;
        $this->noPreloadTag = $noPreloadTag;
        $this->privateTagName = $privateTagName;
    }

    public function process(ContainerBuilder $container)
    {
        $commandServices = $container->findTaggedServiceIds($this->commandTag, true);
>>>>>>> origin/New-FakeMain
        $lazyCommandMap = [];
        $lazyCommandRefs = [];
        $serviceIds = [];

        foreach ($commandServices as $id => $tags) {
            $definition = $container->getDefinition($id);
<<<<<<< HEAD
            $definition->addTag('container.no_preload');
=======
            $definition->addTag($this->noPreloadTag);
>>>>>>> origin/New-FakeMain
            $class = $container->getParameterBag()->resolveValue($definition->getClass());

            if (isset($tags[0]['command'])) {
                $aliases = $tags[0]['command'];
            } else {
                if (!$r = $container->getReflectionClass($class)) {
                    throw new InvalidArgumentException(sprintf('Class "%s" used for service "%s" cannot be found.', $class, $id));
                }
                if (!$r->isSubclassOf(Command::class)) {
<<<<<<< HEAD
                    throw new InvalidArgumentException(sprintf('The service "%s" tagged "%s" must be a subclass of "%s".', $id, 'console.command', Command::class));
=======
                    throw new InvalidArgumentException(sprintf('The service "%s" tagged "%s" must be a subclass of "%s".', $id, $this->commandTag, Command::class));
>>>>>>> origin/New-FakeMain
                }
                $aliases = $class::getDefaultName();
            }

            $aliases = explode('|', $aliases ?? '');
            $commandName = array_shift($aliases);

            if ($isHidden = '' === $commandName) {
                $commandName = array_shift($aliases);
            }

            if (null === $commandName) {
<<<<<<< HEAD
                if (!$definition->isPublic() || $definition->isPrivate() || $definition->hasTag('container.private')) {
=======
                if (!$definition->isPublic() || $definition->isPrivate() || $definition->hasTag($this->privateTagName)) {
>>>>>>> origin/New-FakeMain
                    $commandId = 'console.command.public_alias.'.$id;
                    $container->setAlias($commandId, $id)->setPublic(true);
                    $id = $commandId;
                }
                $serviceIds[] = $id;

                continue;
            }

            $description = $tags[0]['description'] ?? null;

            unset($tags[0]);
            $lazyCommandMap[$commandName] = $id;
            $lazyCommandRefs[$id] = new TypedReference($id, $class);

            foreach ($aliases as $alias) {
                $lazyCommandMap[$alias] = $id;
            }

            foreach ($tags as $tag) {
                if (isset($tag['command'])) {
                    $aliases[] = $tag['command'];
                    $lazyCommandMap[$tag['command']] = $id;
                }

                $description = $description ?? $tag['description'] ?? null;
            }

            $definition->addMethodCall('setName', [$commandName]);

            if ($aliases) {
                $definition->addMethodCall('setAliases', [$aliases]);
            }

            if ($isHidden) {
                $definition->addMethodCall('setHidden', [true]);
            }

            if (!$description) {
                if (!$r = $container->getReflectionClass($class)) {
                    throw new InvalidArgumentException(sprintf('Class "%s" used for service "%s" cannot be found.', $class, $id));
                }
                if (!$r->isSubclassOf(Command::class)) {
<<<<<<< HEAD
                    throw new InvalidArgumentException(sprintf('The service "%s" tagged "%s" must be a subclass of "%s".', $id, 'console.command', Command::class));
=======
                    throw new InvalidArgumentException(sprintf('The service "%s" tagged "%s" must be a subclass of "%s".', $id, $this->commandTag, Command::class));
>>>>>>> origin/New-FakeMain
                }
                $description = $class::getDefaultDescription();
            }

            if ($description) {
                $definition->addMethodCall('setDescription', [$description]);

                $container->register('.'.$id.'.lazy', LazyCommand::class)
                    ->setArguments([$commandName, $aliases, $description, $isHidden, new ServiceClosureArgument($lazyCommandRefs[$id])]);

                $lazyCommandRefs[$id] = new Reference('.'.$id.'.lazy');
            }
        }

        $container
<<<<<<< HEAD
            ->register('console.command_loader', ContainerCommandLoader::class)
            ->setPublic(true)
            ->addTag('container.no_preload')
=======
            ->register($this->commandLoaderServiceId, ContainerCommandLoader::class)
            ->setPublic(true)
            ->addTag($this->noPreloadTag)
>>>>>>> origin/New-FakeMain
            ->setArguments([ServiceLocatorTagPass::register($container, $lazyCommandRefs), $lazyCommandMap]);

        $container->setParameter('console.command.ids', $serviceIds);
    }
}
