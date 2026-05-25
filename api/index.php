<?php
// Force the current directory to be the project root
chdir(__DIR__ . '/..');

// Include the autoloader and the public index
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../public/index.php';