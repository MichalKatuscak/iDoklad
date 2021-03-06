<?php

namespace Fousky\Component\iDoklad\Util;

use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Register Doctrine annotations for Validator.
 *
 * @author Lukáš Brzák <brzak@fousky.cz>
 */
class AnnotationLoader
{
    /** @var bool $_init */
    protected static $_init = false;

    /**
     * @throws \RuntimeException
     * @throws \ReflectionException
     * @throws \InvalidArgumentException
     */
    public static function init()
    {
        if (false === static::$_init) {
            // inject Composer autoloader inside Doctrine annotation reader.
            AnnotationRegistry::registerLoader([
                require sprintf('%s/autoload.php', static::getVendorPath()),
                'loadClass',
            ]);

            static::$_init = true;
        }
    }

    /**
     * @throws \ReflectionException
     * @throws \RuntimeException
     *
     * @return string
     */
    protected static function getVendorPath(): string
    {
        $reflector = new \ReflectionClass(ClassLoader::class);
        $vendorPath = preg_replace('/^(.*)\\' . DIRECTORY_SEPARATOR . 'composer\\' . DIRECTORY_SEPARATOR . 'ClassLoader\.php$/', '$1', $reflector->getFileName());

        if ($vendorPath && is_dir($vendorPath)) {
            return rtrim($vendorPath, '/\\');
        }

        throw new \RuntimeException('Unable to detect vendor path.');
    }
}
