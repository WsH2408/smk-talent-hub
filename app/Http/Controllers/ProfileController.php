<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // Import untuk PDF

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Tampilkan Profil Publik Siswa
     */
    public function show(User $user): View
    {
        abort_if($user->role !== 'siswa', 404, 'Profil tidak ditemukan.');

        // Eager load skills dan profile
        $user->load(['profile', 'skills', 'projects.category']);

        return view('profile.show', compact('user'));
    }

    /**
     * Download CV dalam bentuk PDF (Wow Factor!)
     */
    public function downloadCV(User $user)
    {
        abort_if($user->role !== 'siswa', 404);

        $data = [
            'user' => $user,
            'profile' => $user->profile,
            'skills' => $user->skills,
            'projects' => $user->projects()->where('status', 'approved')->latest()->get()
        ];

        $pdf = Pdf::loadView('profile.cv-pdf', $data);

        // Nama file: CV_NamaSiswa.pdf
        $filename = 'CV_' . str_replace(' ', '_', $user->name) . '.pdf';

        return $pdf->download($filename);
    }
}