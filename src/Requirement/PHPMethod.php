<?php

namespace Fabrikage\Requirements\Requirement;

/**
 * Checks if a PHP method is found in a class.
 */
class PHPMethod extends AbstractRequirement
{
    private string $class;
    private string $method;

    public function __construct(string $class, string $method)
    {
        $this->class = $class;
        $this->method = $method;

        parent::__construct();
    }

    public function isMet(): bool
    {
        return method_exists($this->class, $this->method);
    }

    public function getErrorMessage(): string
    {
        return sprintf('PHP method "%s" is not found in class "%s".', $this->method, $this->class);
    }
}
