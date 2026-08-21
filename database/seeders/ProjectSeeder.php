<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada kategori
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->command->error('Tidak ada kategori! Jalankan CategorySeeder dulu.');
            return;
        }

        // Ambil semua siswa
        $students = User::where('role', 'siswa')->get();
        if ($students->isEmpty()) {
            $this->command->error('Tidak ada siswa! Jalankan UserSeeder dulu.');
            return;
        }

        // Data proyek dummy
        $projects = [
            [
                'judul' => 'Sistem Informasi Perpustakaan Digital',
                'deskripsi' => "Aplikasi web untuk mengelola perpustakaan sekolah dengan fitur lengkap:\n\n• Katalog buku digital dengan pencarian canggih\n• Sistem peminjaman dan pengembalian otomatis\n• Notifikasi email untuk keterlambatan\n• Laporan statistik bulanan\n• Integrasi dengan barcode scanner\n\nProyek ini dibangun untuk memudahkan petugas perpustakaan dalam mengelola ribuan koleksi buku dan meningkatkan efisiensi layanan peminjaman.",
                'category_key' => 'RPL',
                'tools' => ['Laravel', 'MySQL', 'Bootstrap', 'JavaScript', 'jQuery'],
                'link_demo' => 'https://perpustakaan-demo.example.com',
                'link_github' => 'https://github.com/student/perpustakaan-digital',
                'tanggal_mulai' => '2025-09-01',
                'tanggal_selesai' => '2025-11-30',
            ],
            [
                'judul' => 'Aplikasi Kasir UMKM Berbasis Web',
                'deskripsi' => "Sistem Point of Sale (POS) modern untuk membantu pelaku UMKM mengelola transaksi penjualan:\n\n• Manajemen produk dan stok real-time\n• Laporan penjualan harian, mingguan, bulanan\n• Multi-user dengan hak akses berbeda\n• Cetak struk thermal printer\n• Dashboard analitik dengan grafik\n• Export laporan ke PDF dan Excel\n\nDirancang dengan UI yang simpel agar mudah digunakan oleh pemilik toko yang tidak familiar dengan teknologi.",
                'category_key' => 'RPL',
                'tools' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL', 'Chart.js'],
                'link_demo' => 'https://kasir-umkm.example.com',
                'link_github' => 'https://github.com/student/kasir-umkm',
                'tanggal_mulai' => '2025-08-15',
                'tanggal_selesai' => '2025-12-10',
            ],
            [
                'judul' => 'Website Portfolio Fotografi',
                'deskripsi' => "Website portfolio profesional untuk fotografer dengan desain minimalis dan elegan:\n\n• Gallery foto dengan lightbox interaktif\n• Kategori: Wedding, Portrait, Landscape, Event\n• Lazy loading untuk performa optimal\n• Contact form terintegrasi WhatsApp\n• SEO optimized\n• Fully responsive untuk semua device\n\nDibangun dengan fokus pada showcase visual dan pengalaman pengguna yang mulus.",
                'category_key' => 'Multimedia',
                'tools' => ['HTML', 'CSS', 'JavaScript', 'PHP', 'MySQL'],
                'link_demo' => 'https://foto-portfolio.example.com',
                'link_github' => 'https://github.com/student/foto-portfolio',
                'tanggal_mulai' => '2025-10-01',
                'tanggal_selesai' => '2025-11-15',
            ],
            [
                'judul' => 'Sistem Monitoring Jaringan Sekolah',
                'deskripsi' => "Dashboard monitoring untuk admin jaringan sekolah:\n\n• Real-time status semua perangkat (router, switch, AP)\n• Alert otomatis saat ada device down\n• Bandwidth monitoring per VLAN\n• History log dan troubleshooting\n• Map topologi jaringan interaktif\n• Integrasi SNMP untuk data perangkat\n\nMembantu tim IT sekolah dalam maintenance dan troubleshooting jaringan dengan lebih efisien.",
                'category_key' => 'TKJ',
                'tools' => ['Python', 'Django', 'PostgreSQL', 'SNMP', 'Chart.js', 'Docker'],
                'link_demo' => 'https://netmon-school.example.com',
                'link_github' => 'https://github.com/student/network-monitoring',
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-12-20',
            ],
            [
                'judul' => 'Branding & Logo UMKM Kopi Nusantara',
                'deskripsi' => "Proyek branding lengkap untuk kedai kopi lokal:\n\n• Logo design dengan 3 variasi\n• Brand guidelines (warna, tipografi, usage)\n• Packaging design (cup, bag, box)\n• Social media template (Instagram, TikTok)\n• Menu design\n• Merchandise (tote bag, t-shirt, sticker)\n\nKonsep: Modern-tradisional dengan sentuhan budaya lokal. Warna earth-tone dengan aksen hijau kopi.",
                'category_key' => 'DKV',
                'tools' => ['Adobe Illustrator', 'Adobe Photoshop', 'Figma', 'Adobe InDesign'],
                'link_demo' => null,
                'link_github' => null,
                'tanggal_mulai' => '2025-09-15',
                'tanggal_selesai' => '2025-11-01',
            ],
            [
                'judul' => 'E-Learning Platform untuk SMK',
                'deskripsi' => "Platform pembelajaran online khusus untuk siswa SMK:\n\n• Video lesson dengan progress tracking\n• Quiz interaktif dengan auto-grading\n• Forum diskusi per mata pelajaran\n• Upload tugas dan penilaian guru\n• Sertifikat digital setelah lulus course\n• Gamification (badge, leaderboard)\n• Mobile responsive\n\nDirancang untuk mendukung pembelajaran blended learning di sekolah.",
                'category_key' => 'RPL',
                'tools' => ['Laravel', 'Livewire', 'MySQL', 'Tailwind CSS', 'AWS S3'],
                'link_demo' => 'https://elearning-smk.example.com',
                'link_github' => 'https://github.com/student/elearning-platform',
                'tanggal_mulai' => '2025-06-01',
                'tanggal_selesai' => '2025-12-15',
            ],
            [
                'judul' => 'Motion Graphic Promosi SMK',
                'deskripsi' => "Video motion graphic untuk promosi penerimaan siswa baru:\n\n• Durasi: 60 detik\n• Style: Flat design dengan animasi smooth\n• Musik background original\n• Voice over profesional\n• Output: Full HD 1080p\n• Versi: Instagram Reels, YouTube, TikTok\n\nMenampilkan keunggulan jurusan, fasilitas, dan prestasi siswa dengan visual yang menarik dan energik.",
                'category_key' => 'Multimedia',
                'tools' => ['Adobe After Effects', 'Adobe Premiere', 'Adobe Illustrator', 'Audition'],
                'link_demo' => 'https://youtube.com/watch?v=demo-video',
                'link_github' => null,
                'tanggal_mulai' => '2025-10-01',
                'tanggal_selesai' => '2025-10-25',
            ],
            [
                'judul' => 'Konfigurasi Network Lab dengan Cisco Packet Tracer',
                'deskripsi' => "Dokumentasi lengkap konfigurasi jaringan enterprise:\n\n• Topologi: 3 lokasi (Head Office, Branch, Remote)\n• VLAN segmentation (10 VLAN)\n• OSPF routing protocol\n• NAT/PAT untuk internet access\n• ACL untuk security\n• DHCP server configuration\n• Wireless LAN setup\n\nDisertai dokumentasi step-by-step dan troubleshooting guide untuk setiap skenario.",
                'category_key' => 'TKJ',
                'tools' => ['Cisco Packet Tracer', 'GNS3', 'Wireshark', 'VirtualBox'],
                'link_demo' => null,
                'link_github' => 'https://github.com/student/cisco-lab-config',
                'tanggal_mulai' => '2025-08-01',
                'tanggal_selesai' => '2025-10-30',
            ],
            [
                'judul' => 'Desain UI/UX Aplikasi Kesehatan',
                'deskripsi' => "Redesign aplikasi kesehatan dengan fokus pada user experience:\n\n• User research & persona\n• User journey mapping\n• Wireframe (low & high fidelity)\n• Interactive prototype di Figma\n• Usability testing dengan 10 user\n• Design system lengkap\n• Handoff untuk developer\n\nFitur utama: Tracking kesehatan, reminder obat, konsultasi dokter online, dan integrasi wearable device.",
                'category_key' => 'DKV',
                'tools' => ['Figma', 'Adobe XD', 'Miro', 'Notion', 'Maze'],
                'link_demo' => 'https://figma.com/file/demo-health-app',
                'link_github' => null,
                'tanggal_mulai' => '2025-09-01',
                'tanggal_selesai' => '2025-11-20',
            ],
            [
                'judul' => 'Chatbot Customer Service dengan AI',
                'deskripsi' => "Chatbot cerdas untuk layanan pelanggan 24/7:\n\n• Natural Language Processing (NLP)\n• Integrasi WhatsApp Business API\n• FAQ auto-response\n• Handover ke agent manusia\n• Analytics dashboard\n• Multi-language support (ID, EN)\n• Training data dari 1000+ percakapan real\n\nMeningkatkan response time dari 5 menit menjadi instant dan mengurangi beban kerja CS hingga 60%.",
                'category_key' => 'RPL',
                'tools' => ['Python', 'TensorFlow', 'Flask', 'WhatsApp API', 'MongoDB', 'Docker'],
                'link_demo' => 'https://chatbot-demo.example.com',
                'link_github' => 'https://github.com/student/ai-chatbot',
                'tanggal_mulai' => '2025-07-15',
                'tanggal_selesai' => '2025-12-01',
            ],
            [
                'judul' => 'Animasi 2D Short Film "Petualangan Budi"',
                'deskripsi' => "Short film animasi 2D berdurasi 3 menit:\n\n• Storyboard lengkap (30 scene)\n• Character design (5 karakter utama)\n• Background art (10 lokasi)\n• Animasi frame-by-frame\n• Sound design & foley\n• Original soundtrack\n• Output: 4K resolution\n\nKisah tentang anak SMK yang bermimpi menjadi programmer dan perjuangannya meraih cita-cita.",
                'category_key' => 'Multimedia',
                'tools' => ['Adobe Animate', 'Toon Boom Harmony', 'Adobe Audition', 'Blender'],
                'link_demo' => 'https://youtube.com/watch?v=short-film-demo',
                'link_github' => null,
                'tanggal_mulai' => '2025-06-01',
                'tanggal_selesai' => '2025-11-30',
            ],
            [
                'judul' => 'Server Monitoring dengan Grafana & Prometheus',
                'deskripsi' => "Sistem monitoring infrastruktur server production:\n\n• Real-time metrics (CPU, RAM, Disk, Network)\n• Custom dashboard Grafana\n• Alerting via Telegram & Email\n• Log aggregation dengan Loki\n• 30 hari data retention\n• Auto-scaling notification\n• Uptime monitoring 99.9%\n\nDigunakan untuk monitoring 20+ server production dengan load average handling yang optimal.",
                'category_key' => 'TKJ',
                'tools' => ['Linux', 'Grafana', 'Prometheus', 'Docker', 'Nginx', 'Bash'],
                'link_demo' => 'https://monitoring.example.com',
                'link_github' => 'https://github.com/student/server-monitoring',
                'tanggal_mulai' => '2025-08-01',
                'tanggal_selesai' => '2025-10-15',
            ],
        ];

        $this->command->info('Memulai seeding proyek...');

        foreach ($projects as $index => $projectData) {
            // Pilih kategori berdasarkan key
            $category = $categories->firstWhere('name', $projectData['category_key']);
            if (!$category) {
                $this->command->warn("Kategori {$projectData['category_key']} tidak ditemukan, skip.");
                continue;
            }

            // Pilih siswa secara random (rotasi)
            $student = $students[$index % $students->count()];

            // Generate slug
            $slug = Str::slug($projectData['judul']) . '-' . time() . '-' . $index;

            // Buat project
            $project = Project::create([
                'user_id' => $student->id,
                'category_id' => $category->id,
                'judul' => $projectData['judul'],
                'slug' => $slug,
                'deskripsi' => $projectData['deskripsi'],
                'thumbnail' => 'thumbnails/default_' . ($index % 5 + 1) . '.jpg',
                'link_demo' => $projectData['link_demo'],
                'link_github' => $projectData['link_github'],
                'tools' => $projectData['tools'],
                'tanggal_mulai' => $projectData['tanggal_mulai'],
                'tanggal_selesai' => $projectData['tanggal_selesai'],
                'status' => 'approved',
            ]);

            // Tambah 2-4 gambar tambahan per project
            $imageCount = rand(2, 4);
            for ($i = 1; $i <= $imageCount; $i++) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => 'project_images/default_' . $i . '.jpg',
                    'caption' => "Screenshot {$i} - {$projectData['judul']}",
                    'order' => $i - 1,
                ]);
            }

            $this->command->info("✓ Proyek '{$projectData['judul']}' berhasil dibuat untuk {$student->name}");
        }

        $this->command->info('Seeding proyek selesai!');
    }
}
