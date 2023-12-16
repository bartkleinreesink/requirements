<?php

namespace Fabrikage\Requirements\Requirement;

/**
 * Checks the PHP version.
 */
class PHP extends AbstractVersionRequirement
{
    public function getVersion(): string
    {
        return phpversion();
    }

    public function getErrorMessage(): string
    {
        return sprintf(
            'PHP version %s does not meet the version requirement of %s.',
            $this->getVersion(),
            $this->version
        );
    }
}
