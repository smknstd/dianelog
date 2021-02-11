<?php

namespace App\Models;


use App\Models\Utils\WithVisibility;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use WithVisibility;

    protected $guarded = [];

    protected $dates = [
        "created_at",
        "updated_at",
        "publish_date",
    ];

    public function hasMultipleStores() : bool
    {
        return $this->stores()->count() > 1;
    }

    public function pdf()
    {
        return $this->morphOne(Media::class, 'model')
            ->where("model_key", "pdf");
    }

    /**
     * @param string $attribute
     * @return array
     */
    public function getDefaultAttributesFor($attribute)
    {
        return in_array($attribute, ["pdf"])
            ? ["model_key" => $attribute]
            : [];
    }
}
