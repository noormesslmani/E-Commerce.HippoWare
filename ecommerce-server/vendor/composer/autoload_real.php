<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitdd7051cb7a6aa9c2d115a1c1843eeed6
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitdd7051cb7a6aa9c2d115a1c1843eeed6', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitdd7051cb7a6aa9c2d115a1c1843eeed6', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitdd7051cb7a6aa9c2d115a1c1843eeed6::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}