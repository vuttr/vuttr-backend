<?php

namespace Tests\Features;

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
        $response->seeJsonContains([
            'title' => $tool->getAttribute('title'),
            'link' => $tool->getAttribute('link'),
            'description' => $tool->getAttribute('description'),
            'tags' => $tool->tags()->pluck('name')->toArray(),
        ]);
    }
}
