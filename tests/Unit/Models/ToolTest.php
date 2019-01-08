<?php

namespace Tests\Unit\Models;

use App\Models\Tag;
use App\Models\Tool;
use Laravel\Lumen\Testing\DatabaseMigrations;
use TestCase;

class ToolTest extends TestCase
{
    use DatabaseMigrations;

    public function testWithTagAttachNewTag()
    {
        $tool = factory(Tool::class)->create();

        $tool->withTags('amazing');

        $this->assertEquals(['amazing'], $tool->tags()->pluck('name')->toArray());
    }

    public function testWithTagAttachExistingTag()
    {
        $tool = factory(Tool::class)->create();
        $tag = factory(Tag::class)->create();

        $tool->withTags($tag->name);

        $toolTags = $tool->tags()->get();

        $this->assertEquals([$tag->name], $toolTags->pluck('name')->toArray());
        $this->assertEquals([$tag->id], $toolTags->pluck('id')->toArray());
    }

    public function testWithTagAttachExistingTagAndCreatesNewOne()
    {
        $tool = factory(Tool::class)->create();
        $tag = factory(Tag::class)->create();

        $tool->withTags($tag->name, 'amazing');

        $toolTags = $tool->tags()->get();

        $this->assertEquals([$tag->name, 'amazing'], $toolTags->pluck('name')->toArray());
        $this->assertContains($tag->id, $toolTags->pluck('id')->toArray());
    }
}
