<?php

declare(strict_types=1);

namespace Scheb\TwoFactorBundle\Security\TwoFactor\Provider;

use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Exception\UnknownTwoFactorProviderException;

/**
 * @final
 */
class TwoFactorProviderRegistry
{
    public function __construct(private iterable $providers)
    {
    }

    /**
     * @return iterable|TwoFactorProviderInterface[]
     */
    public function getAllProviders(): iterable
    {
        return $this->providers;
    }

    public function getProvider(string $providerName): TwoFactorProviderInterface
    {
        foreach ($this->providers as $name => $provider) {
            if ($name === $providerName) {
                return $provider;
            }
        }

        throw new UnknownTwoFactorProviderException(sprintf('Two-factor provider "%s" does not exist.', $providerName));
    }
}
