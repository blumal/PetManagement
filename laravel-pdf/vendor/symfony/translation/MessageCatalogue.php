<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation;

use Symfony\Component\Config\Resource\ResourceInterface;
use Symfony\Component\Translation\Exception\LogicException;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class MessageCatalogue implements MessageCatalogueInterface, MetadataAwareInterface
{
<<<<<<< HEAD
    private array $messages = [];
    private array $metadata = [];
    private array $resources = [];
    private string $locale;
    private $fallbackCatalogue = null;
    private ?self $parent = null;
=======
    private $messages = [];
    private $metadata = [];
    private $resources = [];
    private $locale;
    private $fallbackCatalogue;
    private $parent;
>>>>>>> origin/New-FakeMain

    /**
     * @param array $messages An array of messages classified by domain
     */
    public function __construct(string $locale, array $messages = [])
    {
        $this->locale = $locale;
        $this->messages = $messages;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getLocale(): string
=======
    public function getLocale()
>>>>>>> origin/New-FakeMain
    {
        return $this->locale;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getDomains(): array
=======
    public function getDomains()
>>>>>>> origin/New-FakeMain
    {
        $domains = [];

        foreach ($this->messages as $domain => $messages) {
            if (str_ends_with($domain, self::INTL_DOMAIN_SUFFIX)) {
                $domain = substr($domain, 0, -\strlen(self::INTL_DOMAIN_SUFFIX));
            }
            $domains[$domain] = $domain;
        }

        return array_values($domains);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function all(string $domain = null): array
=======
    public function all(string $domain = null)
>>>>>>> origin/New-FakeMain
    {
        if (null !== $domain) {
            // skip messages merge if intl-icu requested explicitly
            if (str_ends_with($domain, self::INTL_DOMAIN_SUFFIX)) {
                return $this->messages[$domain] ?? [];
            }

            return ($this->messages[$domain.self::INTL_DOMAIN_SUFFIX] ?? []) + ($this->messages[$domain] ?? []);
        }

        $allMessages = [];

        foreach ($this->messages as $domain => $messages) {
            if (str_ends_with($domain, self::INTL_DOMAIN_SUFFIX)) {
                $domain = substr($domain, 0, -\strlen(self::INTL_DOMAIN_SUFFIX));
                $allMessages[$domain] = $messages + ($allMessages[$domain] ?? []);
            } else {
                $allMessages[$domain] = ($allMessages[$domain] ?? []) + $messages;
            }
        }

        return $allMessages;
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $id, string $translation, string $domain = 'messages')
    {
        $this->add([$id => $translation], $domain);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function has(string $id, string $domain = 'messages'): bool
=======
    public function has(string $id, string $domain = 'messages')
>>>>>>> origin/New-FakeMain
    {
        if (isset($this->messages[$domain][$id]) || isset($this->messages[$domain.self::INTL_DOMAIN_SUFFIX][$id])) {
            return true;
        }

        if (null !== $this->fallbackCatalogue) {
            return $this->fallbackCatalogue->has($id, $domain);
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function defines(string $id, string $domain = 'messages'): bool
=======
    public function defines(string $id, string $domain = 'messages')
>>>>>>> origin/New-FakeMain
    {
        return isset($this->messages[$domain][$id]) || isset($this->messages[$domain.self::INTL_DOMAIN_SUFFIX][$id]);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function get(string $id, string $domain = 'messages'): string
=======
    public function get(string $id, string $domain = 'messages')
>>>>>>> origin/New-FakeMain
    {
        if (isset($this->messages[$domain.self::INTL_DOMAIN_SUFFIX][$id])) {
            return $this->messages[$domain.self::INTL_DOMAIN_SUFFIX][$id];
        }

        if (isset($this->messages[$domain][$id])) {
            return $this->messages[$domain][$id];
        }

        if (null !== $this->fallbackCatalogue) {
            return $this->fallbackCatalogue->get($id, $domain);
        }

        return $id;
    }

    /**
     * {@inheritdoc}
     */
    public function replace(array $messages, string $domain = 'messages')
    {
        unset($this->messages[$domain], $this->messages[$domain.self::INTL_DOMAIN_SUFFIX]);

        $this->add($messages, $domain);
    }

    /**
     * {@inheritdoc}
     */
    public function add(array $messages, string $domain = 'messages')
    {
        if (!isset($this->messages[$domain])) {
            $this->messages[$domain] = [];
        }
        $intlDomain = $domain;
        if (!str_ends_with($domain, self::INTL_DOMAIN_SUFFIX)) {
            $intlDomain .= self::INTL_DOMAIN_SUFFIX;
        }
        foreach ($messages as $id => $message) {
            if (isset($this->messages[$intlDomain]) && \array_key_exists($id, $this->messages[$intlDomain])) {
                $this->messages[$intlDomain][$id] = $message;
            } else {
                $this->messages[$domain][$id] = $message;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addCatalogue(MessageCatalogueInterface $catalogue)
    {
        if ($catalogue->getLocale() !== $this->locale) {
            throw new LogicException(sprintf('Cannot add a catalogue for locale "%s" as the current locale for this catalogue is "%s".', $catalogue->getLocale(), $this->locale));
        }

        foreach ($catalogue->all() as $domain => $messages) {
            if ($intlMessages = $catalogue->all($domain.self::INTL_DOMAIN_SUFFIX)) {
                $this->add($intlMessages, $domain.self::INTL_DOMAIN_SUFFIX);
                $messages = array_diff_key($messages, $intlMessages);
            }
            $this->add($messages, $domain);
        }

        foreach ($catalogue->getResources() as $resource) {
            $this->addResource($resource);
        }

        if ($catalogue instanceof MetadataAwareInterface) {
            $metadata = $catalogue->getMetadata('', '');
            $this->addMetadata($metadata);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addFallbackCatalogue(MessageCatalogueInterface $catalogue)
    {
        // detect circular references
        $c = $catalogue;
        while ($c = $c->getFallbackCatalogue()) {
            if ($c->getLocale() === $this->getLocale()) {
                throw new LogicException(sprintf('Circular reference detected when adding a fallback catalogue for locale "%s".', $catalogue->getLocale()));
            }
        }

        $c = $this;
        do {
            if ($c->getLocale() === $catalogue->getLocale()) {
                throw new LogicException(sprintf('Circular reference detected when adding a fallback catalogue for locale "%s".', $catalogue->getLocale()));
            }

            foreach ($catalogue->getResources() as $resource) {
                $c->addResource($resource);
            }
        } while ($c = $c->parent);

        $catalogue->parent = $this;
        $this->fallbackCatalogue = $catalogue;

        foreach ($catalogue->getResources() as $resource) {
            $this->addResource($resource);
        }
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getFallbackCatalogue(): ?MessageCatalogueInterface
=======
    public function getFallbackCatalogue()
>>>>>>> origin/New-FakeMain
    {
        return $this->fallbackCatalogue;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getResources(): array
=======
    public function getResources()
>>>>>>> origin/New-FakeMain
    {
        return array_values($this->resources);
    }

    /**
     * {@inheritdoc}
     */
    public function addResource(ResourceInterface $resource)
    {
        $this->resources[$resource->__toString()] = $resource;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getMetadata(string $key = '', string $domain = 'messages'): mixed
=======
    public function getMetadata(string $key = '', string $domain = 'messages')
>>>>>>> origin/New-FakeMain
    {
        if ('' == $domain) {
            return $this->metadata;
        }

        if (isset($this->metadata[$domain])) {
            if ('' == $key) {
                return $this->metadata[$domain];
            }

            if (isset($this->metadata[$domain][$key])) {
                return $this->metadata[$domain][$key];
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function setMetadata(string $key, mixed $value, string $domain = 'messages')
=======
    public function setMetadata(string $key, $value, string $domain = 'messages')
>>>>>>> origin/New-FakeMain
    {
        $this->metadata[$domain][$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteMetadata(string $key = '', string $domain = 'messages')
    {
        if ('' == $domain) {
            $this->metadata = [];
        } elseif ('' == $key) {
            unset($this->metadata[$domain]);
        } else {
            unset($this->metadata[$domain][$key]);
        }
    }

    /**
     * Adds current values with the new values.
     *
     * @param array $values Values to add
     */
    private function addMetadata(array $values)
    {
        foreach ($values as $domain => $keys) {
            foreach ($keys as $key => $value) {
                $this->setMetadata($key, $value, $domain);
            }
        }
    }
}
