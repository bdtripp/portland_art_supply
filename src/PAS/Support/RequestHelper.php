<?php

namespace PAS\Support;

class RequestHelper
{
    public function paramMatches(string $param, string $value): bool
    {
        if (!array_key_exists($param, $_GET) || !is_string($_GET[$param])) {
            return false;
        }

        $sanitized = filter_var($_GET[$param], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        return $sanitized === $value;
    }

    public function getPostString(string $key): ?string
    {
        $raw = $this->getRawPostValue($key);

        if ($raw === null) {
            return null;
        }

        $value = trim($raw);

        return $value !== '' ? $value : null;
    }

    public function getPostInt(string $key): ?int
    {
        return $this->filterValue(
            $this->getRawPostValue($key),
            FILTER_VALIDATE_INT
        );
    }

    public function getPostFloat(string $key): ?float
    {
        return $this->filterValue(
            $this->getRawPostValue($key),
            FILTER_VALIDATE_FLOAT
        );
    }

    public function getPostEmail(string $key): ?string
    {
        return $this->filterValue(
            $this->getRawPostValue($key),
            FILTER_VALIDATE_EMAIL
        );
    }

    public function getPostBool(string $key): ?bool
    {
        $raw = $this->getRawPostValue($key);

        if ($raw === null) {
            return false;
        }

        return filter_var($raw, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

    private function getRawPostValue(string $key): ?string
    {
        if (!array_key_exists($key, $_POST)) {
            return null;
        }

        $raw = $_POST[$key];

        return is_string($raw) ? $raw : null;
    }

    private function filterValue(?string $raw, int $filter): mixed
    {
        if ($raw === null) {
            return null;
        }

        $value = filter_var($raw, $filter);

        return $value !== false ? $value : null;
    }

    public function isKeySet(string $key): bool
    {
        return array_key_exists($key, $_POST);
    }
}
