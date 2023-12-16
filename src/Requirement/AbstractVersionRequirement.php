<?php

namespace Fabrikage\Requirements\Requirement;

abstract class AbstractVersionRequirement extends AbstractRequirement
{
    public string $version;
    public string $exceptionType = RequirementVersionException::class;

    use \Fabrikage\Requirements\Traits\VersionParser;

    public function __construct(string $version = '', bool $throwException = true)
    {
        $this->version = $version;

        parent::__construct($throwException);
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
}
