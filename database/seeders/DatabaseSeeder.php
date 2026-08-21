<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Skills;
use App\Models\StudentProfile;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Admin
        User::factory()->create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@smk.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Buat Rekruter
        User::factory(2)->create(['role' => 'rekruter']);

        // 3. Buat Kategori
        $categoriesData = [
            ['name' => 'RPL', 'slug' => 'rpl'],
            ['name' => 'Desain Grafis', 'slug' => 'desain-grafis'],
            ['name' => 'Video Editing', 'slug' => 'video-editing'],
            ['name' => 'Multimedia', 'slug' => 'multimedia'],
            ['name' => 'TKJ', 'slug' => 'tkj'],
            ['name' => 'Web Development', 'slug' => 'web-development'],
        ];

        foreach ($categoriesData as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 4. Buat Skills (Gabungan dari kode kamu, tanpa duplikat)
        $skillsData = [
            'Laravel', 'PHP', 'JavaScript', 'React', 'Vue', 'Tailwind CSS',
            'Figma', 'Adobe Photoshop', 'Adobe Illustrator', 'Adobe Premiere',
            'After Effects', 'Blender', 'MySQL', 'HTML', 'CSS', 'Flutter',
            'Node.js', 'Python', 'Java', 'C#', 'Git', 'Docker'
        ];

        foreach ($skillsData as $skillName) {
            Skill::firstOrCreate(['name' => $skillName]);
        }

        // 5. Buat Siswa
        $siswas = User::factory(10)->create(['role' => 'siswa']);
        $categoriesList = Category::all();
        $skillsList = Skill::all();

        // 6. Loop setiap siswa untuk bikin profil & skill
        foreach ($siswas as $siswa) {
            StudentProfile::create([
                'user_id' => $siswa->id,
                'jurusan' => fake()->randomElement(['RPL', 'Multimedia', 'TKJ', 'Desain Komunikasi Visual']),
                'tagline' => fake()->jobTitle(),
                'phone' => '08' . fake()->numerify('##########'),
            ]);

            $siswa->skills()->attach(
                $skillsList->random(rand(2, 5))->pluck('id')->toArray()
            );
        }

        // 7. BUAT PROYEK DENGAN DATA LENGKAP (Pengganti Project::factory)
        $projectsData = [
            [
                'judul' => 'Sistem Informasi Perpustakaan Digital',
                'deskripsi' => "Aplikasi web untuk mengelola perpustakaan sekolah dengan fitur katalog digital, peminjaman otomatis, dan laporan statistik bulanan.",
                'category_name' => 'RPL',
                'tools' => ['Laravel', 'MySQL', 'Bootstrap', 'JavaScript'],
                'link_demo' => 'https://perpustakaan-demo.example.com',
                'link_github' => 'https://github.com/student/perpustakaan-digital',
            ],
            [
                'judul' => 'Aplikasi Kasir UMKM Berbasis Web',
                'deskripsi' => "Sistem Point of Sale (POS) modern untuk membantu pelaku UMKM mengelola transaksi penjualan, stok real-time, dan laporan analitik.",
                'category_name' => 'Web Development',
                'tools' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL'],
                'link_demo' => 'https://kasir-umkm.example.com',
                'link_github' => 'https://github.com/student/kasir-umkm',
            ],
            [
                'judul' => 'Website Portfolio Fotografi',
                'deskripsi' => "Website portfolio profesional dengan desain minimalis, gallery foto interaktif, lazy loading, dan SEO optimized.",
                'category_name' => 'Multimedia',
                'tools' => ['HTML', 'CSS', 'JavaScript', 'PHP'],
                'link_demo' => 'https://foto-portfolio.example.com',
                'link_github' => 'https://github.com/student/foto-portfolio',
            ],
            [
                'judul' => 'Sistem Monitoring Jaringan Sekolah',
                'deskripsi' => "Dashboard monitoring real-time untuk admin jaringan sekolah: status perangkat, alert otomatis, dan bandwidth monitoring per VLAN.",
                'category_name' => 'TKJ',
                'tools' => ['Python', 'Django', 'PostgreSQL', 'SNMP', 'Docker'],
                'link_demo' => 'https://netmon-school.example.com',
                'link_github' => 'https://github.com/student/network-monitoring',
            ],
            [
                'judul' => 'Branding & Logo UMKM Kopi Nusantara',
                'deskripsi' => "Proyek branding lengkap: logo design, brand guidelines, packaging design, social media template, dan merchandise.",
                'category_name' => 'Desain Grafis',
                'tools' => ['Adobe Illustrator', 'Adobe Photoshop', 'Figma'],
                'link_demo' => null,
                'link_github' => null,
            ],
            [
                'judul' => 'Motion Graphic Promosi SMK',
                'deskripsi' => "Video motion graphic durasi 60 detik untuk promosi penerimaan siswa baru dengan style flat design dan animasi smooth.",
                'category_name' => 'Video Editing',
                'tools' => ['Adobe After Effects', 'Adobe Premiere', 'Adobe Illustrator'],
                'link_demo' => 'https://youtube.com/watch?v=demo-video',
                'link_github' => null,
            ],
            [
                'judul' => 'Chatbot Customer Service dengan AI',
                'deskripsi' => "Chatbot cerdas untuk layanan pelanggan 24/7 dengan NLP, integrasi WhatsApp Business API, dan analytics dashboard.",
                'category_name' => 'RPL',
                'tools' => ['Python', 'TensorFlow', 'Flask', 'WhatsApp API', 'MongoDB'],
                'link_demo' => 'https://chatbot-demo.example.com',
                'link_github' => 'https://github.com/student/ai-chatbot',
            ],
            [
                'judul' => 'Desain UI/UX Aplikasi Kesehatan',
                'deskripsi' => "Redesign aplikasi kesehatan dengan user research, wireframe, interactive prototype di Figma, dan usability testing.",
                'category_name' => 'Desain Grafis',
                'tools' => ['Figma', 'Adobe XD', 'Miro', 'Notion'],
                'link_demo' => 'https://figma.com/file/demo-health-app',
                'link_github' => null,
            ],
        ];

        $this->command->info('Memulai seeding proyek...');

        foreach ($projectsData as $index => $pData) {
            $category = $categoriesList->firstWhere('name', $pData['category_name']);
            $student = $siswas[$index % $siswas->count()]; // Rotasi siswa

            // Buat Project
            $project = Project::create([
                'user_id' => $student->id,
                'category_id' => $category->id,
                'judul' => $pData['judul'],
                'slug' => Str::slug($pData['judul']) . '-' . time() . '-' . $index,
                'deskripsi' => $pData['deskripsi'],
                // Pastikan kamu punya gambar dummy di storage/app/public/thumbnails/
                'thumbnail' => 'thumbnails/default_' . (($index % 5) + 1) . '.jpg',
                'link_demo' => $pData['link_demo'],
                'link_github' => $pData['link_github'],
                'tools' => $pData['tools'],
                'tanggal_mulai' => fake()->dateTimeBetween('-1 year', '-6 months')->format('Y-m-d'),
                'tanggal_selesai' => fake()->dateTimeBetween('-5 months', 'now')->format('Y-m-d'),
                'status' => 'approved',
            ]);

            // Tambah 2-3 gambar tambahan per project
            $imageCount = rand(2, 3);
            for ($i = 1; $i <= $imageCount; $i++) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => 'project_images/default_' . $i . '.jpg',
                    'caption' => "Screenshot {$i} - {$pData['judul']}",
                    'order' => $i - 1,
                ]);
            }

            $this->command->info("✓ Proyek '{$pData['judul']}' dibuat untuk {$student->name}");
        }

        $this->command->info('Seeding selesai! Website siap presentasi. 🚀');
    }
}
