<?php

namespace Tests\Features;

use App\Models\Tool;
use Laravel\Lumen\Testing\DatabaseMigrations;
use TestCase;

class ToolsCreateTest extends TestCase
{
    use DatabaseMigrations;

    public function testIncludeExistingTool()
    {
        /** @var Tool $tool */
        $tool = factory(Tool::class)->make();

        $response = $this->post('tools', [
            'title' => $tool->getAttribute('title'),
            'link' => $tool->getAttribute('link'),
            'description' => $tool->getAttribute('description'),
        ]);

        $response->assertResponseStatus(201);
        $response->seeJsonStructure(['title', 'link', 'description']);
        $response->seeJsonContains([
            'title' => $tool->getAttribute('title'),
            'link' => $tool->getAttribute('link'),
            'description' => $tool->getAttribute('description'),
        ]);
    }
}
