<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd751713988987e9331980363e24189ce
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Service\\' => 8,
        ),
        'R' => 
        array (
            'Repository\\' => 11,
        ),
        'M' => 
        array (
            'Model\\' => 6,
        ),
        'H' => 
        array (
            'Helper\\' => 7,
        ),
        'E' => 
        array (
            'Exception\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Service\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Service',
        ),
        'Repository\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Repository',
        ),
        'Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Model',
        ),
        'Helper\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Helper',
        ),
        'Exception\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Exception',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd751713988987e9331980363e24189ce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd751713988987e9331980363e24189ce::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd751713988987e9331980363e24189ce::$classMap;

        }, null, ClassLoader::class);
    }
}