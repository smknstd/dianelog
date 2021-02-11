<?php

namespace App\Models\Utils;

use Illuminate\Database\Eloquent\Builder;

trait WithVisibility
{
    public static string $online = "online";
    public static string $offline = "offline";

    public static function scopeVisible(Builder $builder): void
    {
        $builder->where("visibility", static::$online);
    }

    public function isVisible(): bool
    {
        return $this->visibility === static::$online;
    }
}
