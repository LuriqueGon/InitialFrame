<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd14d294f41ffbc615f881ea61b58bee2
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'I' => 
        array (
            'IF\\' => 3,
        ),
        'C' => 
        array (
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'IF\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Vendor/InitialFramework',
        ),
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Config',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd14d294f41ffbc615f881ea61b58bee2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd14d294f41ffbc615f881ea61b58bee2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd14d294f41ffbc615f881ea61b58bee2::$classMap;

        }, null, ClassLoader::class);
    }
}