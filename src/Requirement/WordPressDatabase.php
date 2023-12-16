<?php

namespace Fabrikage\Requirements\Requirement;

/**
 * Checks the WordPress database version.
 */
class WordPressDatabase extends AbstractVersionRequirement
{
    public function getVersion(): string
    {
        global $wpdb;

        return $wpdb->db_version();
    }

    public function getErrorMessage(): string
    {
        return sprintf(
            'WordPress database version %s does not meet the version requirement of %s.',
            $this->getVersion(),
            $this->version
        );
    }
}
