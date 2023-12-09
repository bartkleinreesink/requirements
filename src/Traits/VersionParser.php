<?php

namespace Fabrikage\Requirements\Traits;

trait VersionParser
{
    public array $comparators = [
        '!=' => 'not equal to',
        '<=' => 'less than or equal to',
        '>=' => 'greater than or equal to',
        '>' => 'greater than',
        '<' => 'less than',
        '=' => 'equal to',
    ];

    public function getVersionComparator(string $version = ''): string
    {
        if (isset($this->version) && empty($version)) {
            $version = $this->version;
        }

        $version = str_replace([' ', '-'], '', $version);

        foreach ($this->comparators as $comparator => $description) {
            if (strpos($version, $comparator) === 0) {
                return $comparator;
            }
        }

        return '>=';
    }

    public function removeVersionComparator(string $version = ''): string
    {
        if (isset($this->version) && empty($version)) {
            $version = $this->version;
        }

        $version = str_replace([' ', '-'], '', $version);

        foreach ($this->comparators as $comparator => $description) {
            if (strpos($version, $comparator) === 0) {
                $version = substr($version, strlen($comparator));
            }
        }

        return $version;
    }

    /**
     * @param string $version
     * @return array
     */
    public function parseVersion(string $version = '', bool $asString = false): array|string
    {
        if (isset($this->version) && empty($version)) {
            $version = $this->version;
        }

        $version = $this->removeVersionComparator($version);

        if ($asString) {
            return $version;
        }

        $version = str_replace([' ', '-'], '', $version);
        $version = explode('.', $version);

        $major = $version[0] ?? 0;
        $minor = $version[1] ?? 0;
        $patch = $version[2] ?? 0;

        return [
            'major' => $major,
            'minor' => $minor,
            'patch' => $patch,
        ];
    }

    public function version(): string
    {
        return (string) $this->getVersion();
    }

    /**
     * @param string $version
     * @return string
     */
    public function getMajorVersion(string $version = ''): string
    {
        if (isset($this->version) && empty($version)) {
            $version = $this->version;
        }

        $version = $this->parseVersion($version);

        return $version['major'];
    }

    /**
     * @param string $version
     * @return string
     */
    public function getMinorVersion(string $version = ''): string
    {
        if (isset($this->version) && empty($version)) {
            $version = $this->version;
        }

        $version = $this->parseVersion($version);

        return $version['minor'];
    }

    /**
     * @param string $version
     * @return string
     */
    public function getPatchVersion(string $version = ''): string
    {
        if (isset($this->version) && empty($version)) {
            $version = $this->version;
        }

        $version = $this->parseVersion($version);

        return $version['patch'];
    }
}
