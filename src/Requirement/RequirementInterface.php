<?php

namespace Fabrikage\Requirements\Requirement;

interface RequirementInterface
{
    public function isMet(): bool;
    public function getErrorMessage(): string;
    public function getThrowException(): bool;
}
