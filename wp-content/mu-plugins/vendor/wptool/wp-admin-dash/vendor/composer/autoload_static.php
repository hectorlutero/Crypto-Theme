<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita60da5da162595825000e0b6836b45a9
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Wptool\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Wptool\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita60da5da162595825000e0b6836b45a9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita60da5da162595825000e0b6836b45a9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita60da5da162595825000e0b6836b45a9::$classMap;

        }, null, ClassLoader::class);
    }
}