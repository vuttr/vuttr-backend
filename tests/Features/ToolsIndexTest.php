<?php

namespace Tests\Features;

use App\Models\Tag;
use App\Models\Tool;
use Laravel\Lumen\Testing\DatabaseMigrations;
use TestCase;

class ToolsIndexTest extends TestCase
{
    use DatabaseMigrations;

    public function testIncludeExistingTool()
    {
        /** @var Tool $tool */
        $tool = factory(Tool::class)->create();

        $response = $this->get('tools');

        $response->assertResponseOk();
        $response->seeJsonStructure(['*' => ['title', 'link', 'description', 'tags']]);
        $response->seeJson([
            'title' => $tool->getAttribute('title'),
            'link' => $tool->getAttribute('link'),
            'description' => $tool->getAttribute('description'),
            'tags' => $tool->tags()->pluck('name')->toArray(),
        ]);
    }

    public function testFilterByTag()
    {
        /** @var Tool $tool */
        $tool = factory(Tool::class)->create();
        $anotherTool = factory(Tool::class)->create();
        $tag = factory(Tag::class)->create(['name' => 'amazing']);

        $tool->tags()->attach($tag->getKey());

        $response = $this->get('tools?tag=amazing');

        $response->assertResponseOk();
        $response->seeJsonStructure(['*' => ['title', 'link', 'description', 'tags']]);
        $response->seeJson(['id' => $tool->getKey()]);
        $response->dontSeeJson(['id' => $anotherTool->getKey()]);
    }
}
