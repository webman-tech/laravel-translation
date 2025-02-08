<?php

namespace WebmanTech\LaravelTranslation\Helper;

/**
 * @internal
 */
final class ConfigHelper
{
    /**
     * 获取配置
     * @param string $key
     * @param $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        return config("plugin.webman-tech.laravel-translation.{$key}", $default);
    }

    /**
     * 获取全局配置
     * @param string $key
     * @param $default
     * @return mixed
     */
    public static function getGlobal(string $key, $default = null)
    {
        return config($key, $default);
    }
}
