<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb94d99c1bde416f69fdd40326850434a
{
    public static $prefixLengthsPsr4 = array (
        'e' => 
        array (
            'eftec\\bladeone\\' => 15,
        ),
        'P' => 
        array (
            'Phroute\\Phroute\\' => 16,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'eftec\\bladeone\\' => 
        array (
            0 => __DIR__ . '/..' . '/eftec/bladeone/lib',
        ),
        'Phroute\\Phroute\\' => 
        array (
            0 => __DIR__ . '/..' . '/phroute/phroute/src/Phroute',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb94d99c1bde416f69fdd40326850434a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb94d99c1bde416f69fdd40326850434a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb94d99c1bde416f69fdd40326850434a::$classMap;

        }, null, ClassLoader::class);
    }
}
