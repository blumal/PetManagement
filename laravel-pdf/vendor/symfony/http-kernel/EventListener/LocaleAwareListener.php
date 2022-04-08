<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\Translation\LocaleAwareInterface;

/**
 * Pass the current locale to the provided services.
 *
 * @author Pierre Bobiet <pierrebobiet@gmail.com>
 */
class LocaleAwareListener implements EventSubscriberInterface
{
<<<<<<< HEAD
    private iterable $localeAwareServices;
=======
    private $localeAwareServices;
>>>>>>> origin/New-FakeMain
    private $requestStack;

    /**
     * @param iterable<mixed, LocaleAwareInterface> $localeAwareServices
     */
    public function __construct(iterable $localeAwareServices, RequestStack $requestStack)
    {
        $this->localeAwareServices = $localeAwareServices;
        $this->requestStack = $requestStack;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $this->setLocale($event->getRequest()->getLocale(), $event->getRequest()->getDefaultLocale());
    }

    public function onKernelFinishRequest(FinishRequestEvent $event): void
    {
        if (null === $parentRequest = $this->requestStack->getParentRequest()) {
            foreach ($this->localeAwareServices as $service) {
                $service->setLocale($event->getRequest()->getDefaultLocale());
            }

            return;
        }

        $this->setLocale($parentRequest->getLocale(), $parentRequest->getDefaultLocale());
    }

<<<<<<< HEAD
    public static function getSubscribedEvents(): array
=======
    public static function getSubscribedEvents()
>>>>>>> origin/New-FakeMain
    {
        return [
            // must be registered after the Locale listener
            KernelEvents::REQUEST => [['onKernelRequest', 15]],
            KernelEvents::FINISH_REQUEST => [['onKernelFinishRequest', -15]],
        ];
    }

    private function setLocale(string $locale, string $defaultLocale): void
    {
        foreach ($this->localeAwareServices as $service) {
            try {
                $service->setLocale($locale);
            } catch (\InvalidArgumentException $e) {
                $service->setLocale($defaultLocale);
            }
        }
    }
}
