<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Skills;
use App\Models\StudentProfile;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Admin
        User::factory()->create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@smk.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Buat Kategori yang Relevan untuk SMK
        $categories = [
            ['name' => 'RPL', 'slug' => 'rpl'],
            ['name' => 'Desain Grafis', 'slug' => 'desain-grafis'],
            ['name' => 'Video Editing', 'slug' => 'video-editing'],
            ['name' => 'Multimedia', 'slug' => 'multimedia'],
            ['name' => 'TKJ', 'slug' => 'tkj'],
            ['name' => 'Web Development', 'slug' => 'web-development'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 3. Buat Skills
        $skills = [
            'Laravel', 'PHP', 'JavaScript', 'React', 'Vue', 'Tailwind CSS',
            'Figma', 'Adobe Photoshop', 'Adobe Illustrator', 'Adobe Premiere',
            'After Effects', 'Blender', 'MySQL', 'HTML', 'CSS', 'Flutter'
        ];

        foreach ($skills as $skillName) {
            Skills::firstOrCreate(['name' => $skillName]);
        }

        // 4. Buat Siswa & Rekruter
        $siswas = User::factory(10)->create(['role' => 'siswa']);
        User::factory(2)->create(['role' => 'rekruter']);

        // 5. Ambil kategori dan skill yang sudah dibuat
        $categoriesList = Category::all();
        $skillsList = Skills::all();

        // 6. Loop setiap siswa untuk bikin profil, skill, dan proyek
        foreach ($siswas as $siswa) {
            // Bikin profil
            StudentProfile::create([
                'user_id' => $siswa->id,
                'jurusan' => fake()->randomElement(['RPL', 'Multimedia', 'TKJ', 'Desain Komunikasi Visual']),
                'tagline' => fake()->jobTitle(),
                'phone' => '08' . fake()->numerify('##########'),
            ]);

            // Attach random skills ke siswa
            $siswa->skills()->attach(
                $skillsList->random(rand(2, 4))->pluck('id')->toArray()
            );
        }

        // 7. Bikin 30 Proyek random
        Project::factory(30)->create();
    }
}