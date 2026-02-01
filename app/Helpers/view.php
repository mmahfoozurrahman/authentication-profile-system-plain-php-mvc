<?php

function view(string $path, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require __DIR__ . '/../Views/' . $path;
}