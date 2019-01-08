<?php

namespace Tests\Unit\Models;

use App\Models\Tag;
use Laravel\Lumen\Testing\DatabaseMigrations;
use TestCase;

class TagTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreateTagsCreateNewTagsFromListOfNames()
    {
        $tagCount = Tag::count();

        Tag::createTags(['amazing', 'beautiful']);

        $this->assertEquals($tagCount + 2, Tag::count());
    }
}
