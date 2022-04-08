<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\ServiceLocatorTagPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TranslatorPass implements CompilerPassInterface
{
<<<<<<< HEAD
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('translator.default')) {
=======
    private $translatorServiceId;
    private $readerServiceId;
    private $loaderTag;
    private $debugCommandServiceId;
    private $updateCommandServiceId;

    public function __construct(string $translatorServiceId = 'translator.default', string $readerServiceId = 'translation.reader', string $loaderTag = 'translation.loader', string $debugCommandServiceId = 'console.command.translation_debug', string $updateCommandServiceId = 'console.command.translation_extract')
    {
        if (0 < \func_num_args()) {
            trigger_deprecation('symfony/translation', '5.3', 'Configuring "%s" is deprecated.', __CLASS__);
        }

        $this->translatorServiceId = $translatorServiceId;
        $this->readerServiceId = $readerServiceId;
        $this->loaderTag = $loaderTag;
        $this->debugCommandServiceId = $debugCommandServiceId;
        $this->updateCommandServiceId = $updateCommandServiceId;
    }

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition($this->translatorServiceId)) {
>>>>>>> origin/New-FakeMain
            return;
        }

        $loaders = [];
        $loaderRefs = [];
<<<<<<< HEAD
        foreach ($container->findTaggedServiceIds('translation.loader', true) as $id => $attributes) {
=======
        foreach ($container->findTaggedServiceIds($this->loaderTag, true) as $id => $attributes) {
>>>>>>> origin/New-FakeMain
            $loaderRefs[$id] = new Reference($id);
            $loaders[$id][] = $attributes[0]['alias'];
            if (isset($attributes[0]['legacy-alias'])) {
                $loaders[$id][] = $attributes[0]['legacy-alias'];
            }
        }

<<<<<<< HEAD
        if ($container->hasDefinition('translation.reader')) {
            $definition = $container->getDefinition('translation.reader');
=======
        if ($container->hasDefinition($this->readerServiceId)) {
            $definition = $container->getDefinition($this->readerServiceId);
>>>>>>> origin/New-FakeMain
            foreach ($loaders as $id => $formats) {
                foreach ($formats as $format) {
                    $definition->addMethodCall('addLoader', [$format, $loaderRefs[$id]]);
                }
            }
        }

        $container
<<<<<<< HEAD
            ->findDefinition('translator.default')
=======
            ->findDefinition($this->translatorServiceId)
>>>>>>> origin/New-FakeMain
            ->replaceArgument(0, ServiceLocatorTagPass::register($container, $loaderRefs))
            ->replaceArgument(3, $loaders)
        ;

        if (!$container->hasParameter('twig.default_path')) {
            return;
        }

        $paths = array_keys($container->getDefinition('twig.template_iterator')->getArgument(1));
<<<<<<< HEAD
        if ($container->hasDefinition('console.command.translation_debug')) {
            $definition = $container->getDefinition('console.command.translation_debug');
=======
        if ($container->hasDefinition($this->debugCommandServiceId)) {
            $definition = $container->getDefinition($this->debugCommandServiceId);
>>>>>>> origin/New-FakeMain
            $definition->replaceArgument(4, $container->getParameter('twig.default_path'));

            if (\count($definition->getArguments()) > 6) {
                $definition->replaceArgument(6, $paths);
            }
        }
<<<<<<< HEAD
        if ($container->hasDefinition('console.command.translation_extract')) {
            $definition = $container->getDefinition('console.command.translation_extract');
=======
        if ($container->hasDefinition($this->updateCommandServiceId)) {
            $definition = $container->getDefinition($this->updateCommandServiceId);
>>>>>>> origin/New-FakeMain
            $definition->replaceArgument(5, $container->getParameter('twig.default_path'));

            if (\count($definition->getArguments()) > 7) {
                $definition->replaceArgument(7, $paths);
            }
        }
    }
}
