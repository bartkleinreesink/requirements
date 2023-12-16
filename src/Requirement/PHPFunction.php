<?php

namespace Fabrikage\Requirements\Requirement;

/**
 * Checks if a PHP function is loaded.
 */
class PHPFunction extends AbstractRequirement
{
    private string $function;

    public function __construct(string $function)
    {
        $this->function = $function;

        parent::__construct();
    }

    public function isMet(): bool
    {
        return function_exists($this->function);
    }

    public function getErrorMessage(): string
    {
        return sprintf('PHP function "%s" is not loaded.', $this->function);
    }
}
