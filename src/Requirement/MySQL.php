<?php

namespace Fabrikage\Requirements\Requirement;

class MySQL extends AbstractRequirement
{
    public function getVersion(): string
    {
        global $wpdb;

        return $wpdb->db_version();
    }

    public function getErrorMessage(): string
    {
        return sprintf(
            'MySQL version %s does not meet the version requirement of %s.',
            $this->getVersion(),
            $this->version
        );
    }
}
