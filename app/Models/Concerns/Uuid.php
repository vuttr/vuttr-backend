<?php

namespace App\Models\Concerns;

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
            $model->{$model->getKeyName()} = Factory::uuid4()->toString();
        });
    }
}
