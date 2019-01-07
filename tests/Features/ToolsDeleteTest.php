<?php

namespace Tests\Features;

use App\Models\Tool;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use TestCase;

class ToolsDeleteTest extends TestCase
{
    use DatabaseMigrations;

    public function testDeleteExistingTool()
    {
        /** @var Tool $tool */
        $tool = factory(Tool::class)->create();

        $response = $this->delete('tools/' . $tool->getKey());

        $response->assertResponseStatus(Response::HTTP_NO_CONTENT);
        $response->notSeeInDatabase('tools', ['id' => $tool->getKey()]);
    }

    public function testFailWhenResourceIsNotFound()
    {
        $response = $this->delete('tools/inexistent-id');

        $response->assertResponseStatus(Response::HTTP_NOT_FOUND);
    }
}
