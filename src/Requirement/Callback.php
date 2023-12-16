<?php

namespace Fabrikage\Requirements\Requirement;

/**
 * Checks if a callback function returns true.
 */
class Callback extends AbstractRequirement
{
    private string $id;
    private \Closure $callback;

    /**
     * @param string $id An identifier for the requirement.
     * @param \Closure $callback The callback function should return true if the requirement is met.
     */
    public function __construct(string $id, \Closure $callback)
    {
        $this->id = $id;
        $this->callback = $callback;

        parent::__construct();
    }

    public function isMet(): bool
    {
        return call_user_func($this->callback);
    }

    public function getErrorMessage(): string
    {
        return sprintf('Callback function "%s" does not return true.', $this->id);
    }
}
