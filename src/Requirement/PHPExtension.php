<?php

namespace Fabrikage\Requirements\Requirement;

/**
 * Checks if a PHP extension is loaded.
 */
class PHPExtension extends AbstractRequirement
{
    private string $extension;

    public function __construct(string $extension)
    {
        $this->extension = $extension;

        parent::__construct();
    }

    public function isMet(): bool
    {
        return extension_loaded($this->extension);
    }

    public function getErrorMessage(): string
    {
        return sprintf('PHP extension "%s" is not loaded.', $this->extension);
    }
}
