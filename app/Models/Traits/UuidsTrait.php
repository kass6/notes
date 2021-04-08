<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait UuidsTrait
{

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $keyName = $model->getKeyName();

            if (empty($model->$keyName)) {
                $model->$keyName = Str::orderedUuid()->toString();
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
