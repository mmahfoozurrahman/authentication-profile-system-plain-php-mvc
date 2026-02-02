<?php

function view(string $path, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require __DIR__ . '/../Views/' . $path;
}

function isActivePage(string $page): bool
{
    return strpos($_SERVER['REQUEST_URI'], $page) !== false;
}