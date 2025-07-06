<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait Uuid7
{
    /**
     * Boot the trait.
     */
    public static function bootUuid7(): void
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Uuid::uuid7();
            }
        });
    }

}

?>
