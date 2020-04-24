<?php

use Nette\Neon\Neon;
use Laminas\Stdlib\ArrayUtils;

require __DIR__ . '/vendor/autoload.php';

array_shift($argv);

$neonFiles = [];
$flags = 0;

foreach ($argv as $neonFile) {
    if ($neonFile == '--multiline') {
        $flags = Neon::BLOCK;
        continue;
    }

    if (!file_exists($neonFile)) {
        fwrite(STDERR, "'$neonFile' doesn't exists\n");
        exit(2);
    }

    if (!is_file($neonFile)) {
        fwrite(STDERR, "'$neonFile' is not a file\n");
        exit(2);
    }

    if (!is_readable($neonFile)) {
        fwrite(STDERR, "'$neonFile' is not readable\n");
        exit(2);
    }

    $neonFiles[] = $neonFile;
}

if (empty($neonFiles)) {
    fwrite(STDERR, <<<STR
    Usage: merge-neon SOURCE...
    
    merge .neon files and write to stdout
    
    Options:
        --multiline    more human-readable format
    
    STR);
    exit(1);
}

$result = [];

foreach ($neonFiles as $neonFile) {
    $result = ArrayUtils::merge($result, Neon::decode(file_get_contents($neonFile)));
}

echo Neon::encode($result, $flags);
