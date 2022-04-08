<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Loader\Configurator\Traits;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

trait RouteTrait
{
    /**
     * @var RouteCollection|Route
     */
    protected $route;

    /**
     * Adds defaults.
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function defaults(array $defaults): static
=======
    final public function defaults(array $defaults): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->addDefaults($defaults);

        return $this;
    }

    /**
     * Adds requirements.
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function requirements(array $requirements): static
=======
    final public function requirements(array $requirements): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->addRequirements($requirements);

        return $this;
    }

    /**
     * Adds options.
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function options(array $options): static
=======
    final public function options(array $options): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->addOptions($options);

        return $this;
    }

    /**
     * Whether paths should accept utf8 encoding.
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function utf8(bool $utf8 = true): static
=======
    final public function utf8(bool $utf8 = true): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->addOptions(['utf8' => $utf8]);

        return $this;
    }

    /**
     * Sets the condition.
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function condition(string $condition): static
=======
    final public function condition(string $condition): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->setCondition($condition);

        return $this;
    }

    /**
     * Sets the pattern for the host.
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function host(string $pattern): static
=======
    final public function host(string $pattern): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->setHost($pattern);

        return $this;
    }

    /**
     * Sets the schemes (e.g. 'https') this route is restricted to.
     * So an empty array means that any scheme is allowed.
     *
     * @param string[] $schemes
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function schemes(array $schemes): static
=======
    final public function schemes(array $schemes): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->setSchemes($schemes);

        return $this;
    }

    /**
     * Sets the HTTP methods (e.g. 'POST') this route is restricted to.
     * So an empty array means that any method is allowed.
     *
     * @param string[] $methods
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function methods(array $methods): static
=======
    final public function methods(array $methods): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->setMethods($methods);

        return $this;
    }

    /**
     * Adds the "_controller" entry to defaults.
     *
     * @param callable|string|array $controller a callable or parseable pseudo-callable
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function controller(callable|string|array $controller): static
=======
    final public function controller($controller): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->addDefaults(['_controller' => $controller]);

        return $this;
    }

    /**
     * Adds the "_locale" entry to defaults.
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function locale(string $locale): static
=======
    final public function locale(string $locale): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->addDefaults(['_locale' => $locale]);

        return $this;
    }

    /**
     * Adds the "_format" entry to defaults.
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function format(string $format): static
=======
    final public function format(string $format): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->addDefaults(['_format' => $format]);

        return $this;
    }

    /**
     * Adds the "_stateless" entry to defaults.
     *
     * @return $this
     */
<<<<<<< HEAD
    final public function stateless(bool $stateless = true): static
=======
    final public function stateless(bool $stateless = true): self
>>>>>>> origin/New-FakeMain
    {
        $this->route->addDefaults(['_stateless' => $stateless]);

        return $this;
    }
}
