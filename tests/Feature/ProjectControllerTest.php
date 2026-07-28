<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_projects_index_returns_view(): void
    {
        Category::factory()->create();
        Project::factory()->create();

        $response = $this->get('/projects');

        $response->assertOk();
        $response->assertViewIs('projects.index');
    }
}
