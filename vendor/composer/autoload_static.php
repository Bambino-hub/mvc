<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite53db7db286d97976f3c1162c39ba2a1
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInite53db7db286d97976f3c1162c39ba2a1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite53db7db286d97976f3c1162c39ba2a1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite53db7db286d97976f3c1162c39ba2a1::$classMap;

        }, null, ClassLoader::class);
    }
}
