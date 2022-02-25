<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Factories\Factory;

trait NewHasFactory
{
    public static function factory(...$parameters)
    {
        $factory = static::newFactory() ?: Factory::factoryForModel(get_called_class());

        return $factory
            ->count(is_numeric($parameters[0] ?? null) ? $parameters[0] : null)
            ->state(is_array($parameters[0] ?? null) ? $parameters[0] : ($parameters[1] ?? []));
    }


    protected static function newFactory()
    {
        return self::$factoryModel::new();
    }
}
