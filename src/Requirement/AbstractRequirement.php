<?php

namespace Fabrikage\Requirements\Requirement;

abstract class AbstractRequirement implements RequirementInterface
{
    /**
     * @var bool $throwException
     */
    public bool $throwException;

    /**
     * @var string $version
     */
    public string $version;

    use \Fabrikage\Requirements\Traits\VersionParser;

    public function __construct(string $version = '', bool $throwException = true)
    {
        $this->throwException = $throwException;
        $this->version = $version;
    }

    protected function isRequirementMet(): bool
    {
        $isMet = $this->isMet();

        if (!$isMet && $this->throwException) {
            throw new RequirementException($this->getErrorMessage());
        }

        return $isMet;
    }

    public function getVersion(): string
    {
        return $this->removeVersionComparator($this->version);
    }

    public function isMet(): bool
    {
        return version_compare(
            $this->getVersion(),
            $this->removeVersionComparator($this->version),
            $this->getVersionComparator($this->version)
        );
    }

    abstract public function getErrorMessage(): string;

    public function getThrowException(): bool
    {
        return $this->throwException;
    }
}
