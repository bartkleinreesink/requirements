<?php

namespace Fabrikage\Requirements;

final class Validator
{
    /**
     * @var Requirement\RequirementInterface[] $requirements
     */
    private array $requirements = [];
    private array $errors = [];
    private bool $throwException;

    public function __construct(bool $throwException = true)
    {
        $this->throwException = $throwException;
    }

    public function __invoke(): bool
    {
        return $this->validate();
    }

    public function valid(): bool
    {
        return $this->validate();
    }

    public function addRequirement(Requirement\RequirementInterface $requirement): static
    {
        $requirement->getThrowException($this->throwException);
        $this->requirements[] = $requirement;

        return $this;
    }

    /**
     * @param Requirement\RequirementInterface[] $requirements
     * @return static
     */
    public function addRequirements(array $requirements): static
    {
        foreach ($requirements as $requirement) {
            if (!$requirement instanceof Requirement\RequirementInterface) {
                throw new ValidatorException('Requirement must implement RequirementInterface');
            }

            $this->addRequirement($requirement);
        }

        return $this;
    }

    public function validate(): bool
    {
        foreach ($this->requirements as $requirement) {
            if ($requirement->isMet()) {
                continue;
            }

            $this->errors[] = $requirement->getErrorMessage();
        }

        if ($this->throwException && !empty($this->errors)) {
            throw new ValidatorException(implode("\n", $this->errors));
        }

        return empty($this->errors);
    }

    /**
     * @return array{'message': string}
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
