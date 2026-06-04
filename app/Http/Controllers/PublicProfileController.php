<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Link;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PublicProfileController extends Controller
{
    /**
     * Display the user's public profile page.
     */
    public function show(string $username): View|Response
    {
        $user = User::where('username', $username)
            ->orWhere('custom_url', $username)
            ->where('is_active', true)
            ->firstOrFail();

        $links = $user->links()
            ->active()
            ->ordered()
            ->get();

        return view('profile.show', [
            'user' => $user,
            'links' => $links,
        ]);
    }

    /**
     * Redirect to the link URL and increment the click count.
     */
    public function redirect(Link $link)
    {
        $link->increment('click_count');
        
        return redirect()->away($link->url);
    }
}
