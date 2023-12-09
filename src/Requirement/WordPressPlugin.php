<?php

namespace Fabrikage\Requirements\Requirement;

class WordPressPlugin extends AbstractRequirement
{
    /**
     * @var string $plugin
     */
    private string $plugin;
    public string $version;

    public function __construct(string $plugin, string $version = '', bool $throwException = true)
    {
        if (!defined('WPINC')) {
            throw new RequirementException('WordPress is not loaded. WPINC is not defined.');
        }

        $this->plugin = $plugin;
        $this->version = $version;

        parent::__construct($version, $throwException);
    }

    private function getPluginData(): array
    {
        if (!function_exists('get_plugin_data')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        return get_plugin_data(WP_PLUGIN_DIR . '/' . $this->plugin);
    }

    public function getVersion(): string
    {
        return $this->getPluginData()['Version'];
    }

    private function isActive(): bool
    {
        if (!function_exists('is_plugin_active')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        return \is_plugin_active($this->plugin);
    }

    public function isMet(): bool
    {
        if ($this->version) {
            return $this->isActive() && $this->versionMet();
        }

        return $this->isActive();
    }

    private function versionMet(): bool
    {
        return version_compare(
            $this->getVersion(),
            $this->removeVersionComparator($this->version),
            $this->getVersionComparator($this->version)
        );
    }

    public function getErrorMessage(): string
    {
        if ($this->version) {
            return sprintf(
                'Plugin %s is not active or does not meet the version requirement of %s.',
                $this->plugin,
                $this->version
            );
        }

        return sprintf(
            'Plugin %s is not active.',
            $this->plugin
        );
    }
}
