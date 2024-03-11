<?php

namespace App\Library;

use App\Library\Traits\RequestTrait;
use App\Library\Traits\ResponseTrait;
use Illuminate\Support\Str;

class Master
{
    use RequestTrait,
        ResponseTrait;

    protected static $_instance = null;

    /**
     * Prevent direct object creation
     */
    final private function __construct()
    {
    }

    /**
     * Prevent object cloning
     */
    private function __clone()
    {
    }

    /**
     * Returns new or existing Singleton instance
     * @return Master
     */
    final public static function getInstance()
    {
        if (null !== static::$_instance) {
            return static::$_instance;
        }
        static::$_instance = new static();
        return static::$_instance;
    }

    public static function hasDebug()
    {
        return config('app.debug', false);
    }

    public static function getModelName($model)
    {
        return Str::afterLast(get_class($model), '\\');
    }

    public static function getEnv()
    {
        return request()->header('env');
    }

    public static function getPaginationCount()
    {
        return config('sysconfig.pagination_count');
    }


}
