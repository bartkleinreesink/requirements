<?php

namespace Fabrikage\Requirements\Requirement;

/**
 * Checks the WordPress version.
 */
class WordPress extends AbstractVersionRequirement
{
    public function getVersion(): string
    {
        if (!defined('WPINC')) {
            throw new RequirementException('WordPress is not loaded. WPINC is not defined.');
        }

        if (!function_exists('get_bloginfo')) {
            require_once ABSPATH . 'wp-includes/functions.php';
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
