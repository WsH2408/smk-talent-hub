<?php

namespace Database\Factories;

use App\Models\Skills;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Skills>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $skills = ['Laravel', 'Figma', 'React', 'PHP', 'Tailwind CSS', 'Adobe Premiere', 'Photoshop', 'Flutter'];
        return ['name' => fake()->randomElement($skills)];
    }
}
