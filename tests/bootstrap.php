<?php

$autoloadPaths = [
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../vemcount/vendor/autoload.php',
];

foreach ($autoloadPaths as $autoloadPath) {
    if (file_exists($autoloadPath)) {
        require $autoloadPath;
        break;
    }
}

require_once __DIR__ . '/../src/Exceptions/POEditorException.php';
require_once __DIR__ . '/../src/Translation.php';
require_once __DIR__ . '/../src/TranslationServiceProvider.php';
