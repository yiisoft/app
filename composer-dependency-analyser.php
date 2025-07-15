<?php

declare(strict_types=1);

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

$root = __DIR__;

$prodPaths = [
    'src',
    'config',
    'resources/views',
    'public/index.php',
    'yii',
];

$devPaths = [
    'tests',
];

$ignoreProdDependenciesOnlyInDev = [
    'psr/container',
    'yiisoft/config',
    'yiisoft/yii-event',
];

$ignoreUnusedDependencies = [
    'yiisoft/router-fastroute',
];

$configuration = (new Configuration())
    ->disableComposerAutoloadPathScan()
    ->setFileExtensions(['php']);
foreach ($prodPaths as $path) {
    $configuration->addPathToScan($root . '/' . $path, isDev: false);
}
foreach ($devPaths as $path) {
    $configuration->addPathToScan($root . '/' . $path, isDev: true);
}
foreach ($ignoreProdDependenciesOnlyInDev as $package) {
    $configuration->ignoreErrorsOnPackage($package, [ErrorType::PROD_DEPENDENCY_ONLY_IN_DEV]);
}
foreach ($ignoreUnusedDependencies as $package) {
    $configuration->ignoreErrorsOnPackage($package, [ErrorType::UNUSED_DEPENDENCY]);
}
return $configuration;
