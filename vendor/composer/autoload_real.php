<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit00c226eecf647d807f9d5afb1423f99e
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

        spl_autoload_register(array('ComposerAutoloaderInit00c226eecf647d807f9d5afb1423f99e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit00c226eecf647d807f9d5afb1423f99e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit00c226eecf647d807f9d5afb1423f99e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}