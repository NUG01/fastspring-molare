<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderIniteae9f079dc0df191b671cad4e3f4a869
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

        spl_autoload_register(array('ComposerAutoloaderIniteae9f079dc0df191b671cad4e3f4a869', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderIniteae9f079dc0df191b671cad4e3f4a869', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticIniteae9f079dc0df191b671cad4e3f4a869::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
