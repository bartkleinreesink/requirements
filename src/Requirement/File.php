<?php

namespace Fabrikage\Requirements\Requirement;

class File extends AbstractRequirement
{
    private string $filepath;

    public function __construct(string $filepath)
    {
        $this->filepath = $filepath;

        parent::__construct();
    }

    public function isMet(): bool
    {
        return file_exists($this->filepath);
    }

    public function getErrorMessage(): string
    {
        return sprintf('File %s does not exist.', $this->filepath);
    }
}
