<?php

namespace App\Models;

use App\Models\Concerns\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;

class Tool extends Model
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
    protected $fillable = ['title', 'link', 'description'];

    /**
     * Get only tools that have a specific tag.
     *
     * @param Builder $query
     * @param string $tag
     */
    public function scopeHasTag($query, $tag)
    {
        if (empty($tag)) {
            return;
        }

        $query->select('tools.*')
            ->join('tag_tool', 'tag_tool.tool_id', '=', 'tools.id')
            ->join('tags', function (JoinClause $join) use ($tag) {
                $join->on('tags.id', '=', 'tag_tool.tag_id')
                    ->where('tags.name', $tag);
            });
    }

    /**
     * Attach tags to tool.
     *
     * @param array|string ...$tagNames
     * @return Tool
     */
    public function withTags($tagNames)
    {
        if (is_string($tagNames)) {
            $tagNames = func_get_args();
        }

        $existingTags = Tag::whereIn('name', $tagNames)->pluck('name', 'id');
        Tag::createTags(array_diff($tagNames, $existingTags->toArray()));

        $this->tags()->sync(Tag::whereIn('name', $tagNames)->pluck('id'));

        return $this;
    }

    /**
     * Represents a database relationship.
     *
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
