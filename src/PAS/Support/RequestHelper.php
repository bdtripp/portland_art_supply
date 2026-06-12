<?php

namespace PAS\Support;

class RequestHelper
{
    public function getPost(string $key): string
    {
        if (isset($_POST[$key])) {
            return htmlentities((string) $_POST[$key]);
        }
        return '';
    }

    public function paramMatches(string $param, mixed $value): bool
    {
        return isset($_GET[$param]) && $_GET[$param] === (string) $value;
    }
}
