<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0f6ed972a9220659e8db93c9c6c10e8b
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'tool\\' => 5,
        ),
        'm' => 
        array (
            'model\\' => 6,
        ),
        'g' => 
        array (
            'glob\\' => 5,
        ),
        'f' => 
        array (
            'framework\\' => 10,
        ),
        'c' => 
        array (
            'controller\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'tool\\' => 
        array (
            0 => __DIR__ . '/../..' . '/../tools',
        ),
        'model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/../handler/models',
        ),
        'glob\\' => 
        array (
            0 => __DIR__ . '/../..' . '/global',
        ),
        'framework\\' => 
        array (
            0 => __DIR__ . '/../..' . '/framework/janggelan/system/src',
        ),
        'controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/../handler/controllers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0f6ed972a9220659e8db93c9c6c10e8b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0f6ed972a9220659e8db93c9c6c10e8b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}