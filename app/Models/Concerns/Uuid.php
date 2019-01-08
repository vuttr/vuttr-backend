<?php

namespace App\Models\Concerns;

use Exception;
use Ramsey\Uuid\Uuid as Factory;

trait Uuid
{
    /**
     * Attach creating event to a model.
     *
     * @return void
     */
    public static function bootUuid()
    {
        static::creating(function (self $model) {
            $model->{$model->getKeyName()} = static::generateUuid();
        });
    }

    /**
     * Generate a new uuid.
     *
     * @return string
     * @throws Exception
     */
    public static function generateUuid()
    {
        return Factory::uuid4()->toString();
    }
}
