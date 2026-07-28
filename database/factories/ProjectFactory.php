<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $judul = fake()->sentence(3);
        return [
            'user_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
            'judul' => $judul,
            'slug' => \Illuminate\Support\Str::slug($judul),
            'deskripsi' => fake()->paragraph(),
            'thumbnail' => 'https://picsum.photos/seed/' . fake()->numberBetween(1, 1000) . '/800/600', // Gambar random dari picsum
            'link_demo' => fake()->url(),
            'status' => 'approved',
        ];
    }
}
