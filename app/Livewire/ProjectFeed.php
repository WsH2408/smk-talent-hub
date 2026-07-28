<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;
use App\Models\Category;

class ProjectFeed extends Component
{
    use WithPagination;

    public $filterKategori = '';
    public $sortBy = 'terbaru';
    public $perPage = 9; // Tampilkan 9 proyek per halaman

    // Reset pagination saat filter berubah
    public function updatingFilterKategori() { $this->resetPage(); }
    public function updatingSortBy() { $this->resetPage(); }

    // Fungsi untuk memuat lebih banyak proyek (Load More)
    public function loadMore()
    {
        $this->perPage += 6;
    }

    public function render()
    {
        // Ambil semua kategori untuk tombol filter
        $categories = Category::all();

        // Query proyek berdasarkan filter
        $projects = Project::with(['user.profile', 'category'])
            ->where('status', 'approved')
            ->when($this->filterKategori, function ($query) {
                $query->where('category_id', $this->filterKategori);
            })
            ->when($this->sortBy == 'terbaru', function ($query) {
                $query->latest();
            })
            ->when($this->sortBy == 'populer', function ($query) {
                $query->withCount('likes')->orderBy('likes_count', 'desc');
            })
            ->paginate($this->perPage);

        return view('livewire.project-feed', compact('projects', 'categories'));
    }
}