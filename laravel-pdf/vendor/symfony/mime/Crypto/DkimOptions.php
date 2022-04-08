<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Mime\Crypto;

/**
 * A helper providing autocompletion for available DkimSigner options.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class DkimOptions
{
<<<<<<< HEAD
    private array $options = [];
=======
    private $options = [];
>>>>>>> origin/New-FakeMain

    public function toArray(): array
    {
        return $this->options;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function algorithm(string $algo): static
=======
    public function algorithm(string $algo): self
>>>>>>> origin/New-FakeMain
    {
        $this->options['algorithm'] = $algo;

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function signatureExpirationDelay(int $show): static
=======
    public function signatureExpirationDelay(int $show): self
>>>>>>> origin/New-FakeMain
    {
        $this->options['signature_expiration_delay'] = $show;

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function bodyMaxLength(int $max): static
=======
    public function bodyMaxLength(int $max): self
>>>>>>> origin/New-FakeMain
    {
        $this->options['body_max_length'] = $max;

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function bodyShowLength(bool $show): static
=======
    public function bodyShowLength(bool $show): self
>>>>>>> origin/New-FakeMain
    {
        $this->options['body_show_length'] = $show;

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function headerCanon(string $canon): static
=======
    public function headerCanon(string $canon): self
>>>>>>> origin/New-FakeMain
    {
        $this->options['header_canon'] = $canon;

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function bodyCanon(string $canon): static
=======
    public function bodyCanon(string $canon): self
>>>>>>> origin/New-FakeMain
    {
        $this->options['body_canon'] = $canon;

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function headersToIgnore(array $headers): static
=======
    public function headersToIgnore(array $headers): self
>>>>>>> origin/New-FakeMain
    {
        $this->options['headers_to_ignore'] = $headers;

        return $this;
    }
}
