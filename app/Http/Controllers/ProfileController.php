<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->safe()->except('avatar'));

        if ($request->hasFile('avatar')) {

            // Hapus avatar lama dari Cloudinary
            if ($user->avatar_public_id) {
                Cloudinary::uploadApi()->destroy($user->avatar_public_id);
            }

            // Upload avatar baru
            $result = Cloudinary::uploadApi()->upload(
                $request->file('avatar')->getRealPath(),
                [
                    'folder' => 'biokuy/avatars',
                ]
            );

            $user->avatar_public_id = $result['public_id'];
            $user->avatar_url = $result['secure_url'];
        }

        $user->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * Delete the user's avatar.
     */
    public function destroyAvatar(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->avatar_public_id) {
            Cloudinary::uploadApi()->destroy($user->avatar_public_id);
        }

        $user->avatar_public_id = null;
        $user->avatar_url = null;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'avatar-deleted');
    }

    /**
     * Update the user's public profile theme settings.
     */
    public function updateTheme(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Proteksi Keamanan: Hanya Student dan Pro yang bisa mengkustomisasi tema
        if ($user->getActivePlan() === \App\Enums\PlanEnum::Free) {
            return Redirect::route('profile.edit')->with('error', 'Kustomisasi tema hanya tersedia untuk pengguna paket Student & Pro.');
        }

        $validated = $request->validate([
            'theme_settings.banner_gradient' => ['required', 'string', 'max:100'],
            'theme_settings.card_style' => ['required', 'string', 'max:50'],
            'theme_settings.font_family' => ['required', 'string', 'max:50'],
            'theme_settings.bg_color' => ['required', 'string', 'max:50'],
            'theme_settings.show_membership' => ['nullable', 'string', 'max:10'],
        ]);

        $settings = $validated['theme_settings'];
        // Tentukan nilai default show_membership jika diset atau tidak diset
        $settings['show_membership'] = isset($settings['show_membership']) && $settings['show_membership'] === 'true' ? 'true' : 'false';

        $user->theme_settings = $settings;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'theme-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        // Hapus avatar dari Cloudinary
        if ($user->avatar_public_id) {
            Cloudinary::uploadApi()->destroy($user->avatar_public_id);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
