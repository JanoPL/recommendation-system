<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    // uncomment to reach your current PHP version
    ->withPhpVersion(PhpVersion::PHP_84)
    ->withTypeCoverageLevel(65)
    ->withDeadCodeLevel(5)
    ->withCodeQualityLevel(10)
    ->withComposerBased(phpunit: true)
    ->withAttributesSets(symfony: true, phpunit: true)
;
