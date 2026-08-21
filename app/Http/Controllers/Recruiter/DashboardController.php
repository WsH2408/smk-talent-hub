<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_projects' => Project::where('status', 'approved')->count(),
            'total_students' => User::where('role', 'siswa')->count(),
            'recent_projects' => Project::with(['user.profile', 'category'])
                ->where('status', 'approved')
                ->latest()
                ->take(6)
                ->get(),
        ];

        return view('recruiter.dashboard', compact('stats'));
    }
}
