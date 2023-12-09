<?php

namespace Fabrikage\Requirements\Requirement;

class WordPress extends AbstractRequirement
{
    public function getVersion(): string
    {
        if (!defined('WPINC')) {
            throw new RequirementException('WordPress is not loaded.');
        }

        if (did_action('init') === 0) {
            throw new RequirementException('WordPress is not initialized.');
        }

        return get_bloginfo('version');
    }

    public function getErrorMessage(): string
    {
        return sprintf(
            'WordPress version %s or higher is required, but you are running %s.',
            $this->removeVersionComparator($this->version),
            $this->getVersion()
        );
    }
}
