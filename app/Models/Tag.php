<?php

namespace App\Models;

use App\Models\Concerns\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Tag extends Model
{
    use Uuid;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Create multiple tags with bulk insert.
     *
     * @param array $tagNames
     * @return Tag[]|Collection
     */
    public static function createTags(array $tagNames)
    {
        return collect($tagNames)->transform(function ($tagName) {
            return [
                'id' => static::generateUuid(),
                'name' => $tagName,
            ];
        })->pipe(function ($tagsAttributes) {
            return static::query()->insert($tagsAttributes->toArray());
        });
    }

    /**
     * Represents a database relationship.
     *
     * @return BelongsToMany
     */
    public function tools()
    {
        return $this->belongsToMany(Tool::class);
    }
}
