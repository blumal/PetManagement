<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Contracts\Translation;

interface LocaleAwareInterface
{
    /**
     * Sets the current locale.
     *
<<<<<<< HEAD
=======
     * @param string $locale The locale
     *
>>>>>>> origin/New-FakeMain
     * @throws \InvalidArgumentException If the locale contains invalid characters
     */
    public function setLocale(string $locale);

    /**
     * Returns the current locale.
<<<<<<< HEAD
     */
    public function getLocale(): string;
=======
     *
     * @return string
     */
    public function getLocale();
>>>>>>> origin/New-FakeMain
}
