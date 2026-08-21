<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Skill;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan Profil Publik (Untuk semua role)
     */
    public function show(User $user): View
    {
        // Load data yang dibutuhkan
        $user->load(['profile', 'skills', 'projects.category']);

        return view('profile.show', compact('user'));
    }

    /**
     * Tampilkan form edit profile (Breeze default)
     */
    public function edit(Request $request): View
    {
        $skills = Skill::all();
        $userSkills = $request->user()->skills->pluck('id')->toArray();

        return view('profile.edit', compact('skills', 'userSkills'));
    }

    /**
     * Update profile info (Breeze default)
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete user account (Breeze default)
     */
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
     * Form Edit Profile Custom (Untuk siswa/admin/rekruter)
     */
    public function editProfile()
    {
        $user = Auth::user();
        $skills = Skill::all();
        $userSkills = $user->skills->pluck('id')->toArray();

        return view('profile.edit', compact('user', 'skills', 'userSkills'));
    }

    /**
     * Update Profile Custom
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        // Update data user dasar
        $user->name = $validated['name'];

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $user->foto_profil = $request->file('foto_profil')->store('avatars', 'public');
        }

        $user->save();

        // Update data spesifik siswa (profile & skills)
        if ($user->role === 'siswa') {
            $profile = $user->profile ?? new StudentProfile(['user_id' => $user->id]);
            $profile->tagline = $validated['tagline'] ?? '';
            $profile->jurusan = $validated['jurusan'] ?? '';
            $profile->phone = $validated['phone'] ?? '';
            $profile->save();

            if (isset($validated['skills'])) {
                $user->skills()->sync($validated['skills']);
            } else {
                $user->skills()->detach();
            }
        }

        return redirect()->route('profile.show', $user)->with('success', '✅ Profil berhasil diupdate!');
    }
}
