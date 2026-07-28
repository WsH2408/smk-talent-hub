<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;

class PageController extends Controller
{
    public function index()
    {
        // Ambil 6 proyek terbaru untuk ditampilkan di landing page
        $featuredProjects = Project::with(['user', 'category'])
            ->where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        // Ambil semua kategori untuk filter
        $categories = Category::all();

        return view('welcome', compact('featuredProjects', 'categories'));
    }
}