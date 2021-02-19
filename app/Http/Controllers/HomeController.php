<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return view('home');
    }

    /**
     * Show user profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('profile');
    }

    /**
     * Update profile.
     *
     * @param ProfileUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $currentPhoto = $user->profile_picture;

        // Update profile
        $user->update([
            'first_name' => $request->first_name ?? $user->first_name,
            'last_name' => $request->last_name ?? $user->last_name,
            'email' => $request->email ?? $user->email,
        ]);

        // Update profile picture
        if ($photo = $request->file('profile_picture')) {
            $user->update([
                'profile_picture' => asset('storage/' . $photo->store('avatars'))
            ]);
        }

        // Remove old profile picture
        if (
            $user->wasChanged('profile_picture')
            && !Str::contains($currentPhoto, 'placeholder')
        ) {
            Storage::delete('avatars/' . basename($currentPhoto));
        }

        $request->session()->flash('status', 'Profile Updated Successfully!');

        return redirect()->route('profile');
    }
}
