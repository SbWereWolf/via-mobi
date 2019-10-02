<?php

namespace test;

class Loader
{
    const GLUE = '\\';
    protected static $_libdir = 'lib';

    public static function init()
    {
        return spl_autoload_register(array(__CLASS__, 'includeClass'));
    }

    public static function includeClass($class)
    {
        require_once(self::toPath($class));
    }

    public static function isReadable(string $class):bool
    {
        $result = is_readable(self::toPath($class));

        return $result;
    }

    /**
     * @param $class
     *
     * @return string
     */
    private static function toPath($class): string
    {
        return PROJECTROOT . '/' . self::$_libdir . '/'
            . strtr($class, '_\\', '//') . '.php';
}
}

function S($class)
{
    $class = __NAMESPACE__ . '\\' . $class;
    return $class::getInstance();
}
