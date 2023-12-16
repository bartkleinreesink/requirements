<?php

namespace Fabrikage\Requirements\Requirement;

abstract class AbstractRequirement implements RequirementInterface
{
    public bool $throwException;
    public string $exceptionType = RequirementException::class;

    public function __construct(bool $throwException = true)
    {
        $this->throwException = $throwException;
    }

    protected function isRequirementMet(): bool
    {
        $isMet = $this->isMet();

        if (!$isMet && $this->throwException) {
            throw new $this->exceptionType($this->getErrorMessage());
        }

        return $isMet;
    }

    abstract public function isMet(): bool;

    abstract public function getErrorMessage(): string;

    public function getThrowException(): bool
    {
        return $this->throwException;
    }
}
