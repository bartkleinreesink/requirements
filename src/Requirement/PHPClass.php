<?php

namespace Fabrikage\Requirements\Requirement;

/**
 * Checks if a PHP class is loaded.
 */
class PHPClass extends AbstractRequirement
{
    private string $class;

    public function __construct(string $class)
    {
        $this->class = $class;

        parent::__construct();
    }

    public function isMet(): bool
    {
        return class_exists($this->class);
    }

    public function getErrorMessage(): string
    {
        return sprintf('PHP class "%s" is not loaded.', $this->class);
    }
}
