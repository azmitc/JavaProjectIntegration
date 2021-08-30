<?php
use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/** @var ClassLoader $loader */

$loader = require __DIR__.'/../vendor/autoload.php';
use Ivory\GoogleMap;
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;
