<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LinkController extends Controller
{
    /**
     * Display a listing of the user's links.
     */
    public function index(Request $request): View
    {
        $links = $request->user()
            ->links()
            ->ordered()
            ->get();

        return view('links.index', [
            'user' => $request->user(),
            'links' => $links,
            'canAddLink' => $request->user()->canAddLink(),
            'linkLimit' => $request->user()->getLinkLimit(),
        ]);
    }

    /**
     * Show the form for creating a new link.
     */
    public function create(Request $request): View
    {
        abort_unless($request->user()->canAddLink(), 403, 'Link limit reached for your plan.');

        return view('links.create');
    }

    /**
     * Store a newly created link.
     */
    public function store(Request $request): RedirectResponse
    {
        abort_unless($request->user()->canAddLink(), 403, 'Link limit reached for your plan.');

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'url' => ['required', 'url', 'max:500'],
            'icon' => ['nullable', 'string', 'max:50'],
        ]);

        $maxOrder = $request->user()->links()->max('sort_order') ?? 0;

        $request->user()->links()->create([
            ...$validated,
            'sort_order' => $maxOrder + 1,
        ]);

        return redirect()
            ->route('links.index')
            ->with('success', 'Link berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified link.
     */
    public function edit(Request $request, Link $link): View
    {
        abort_unless($link->user_id === $request->user()->id, 403);

        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified link.
     */
    public function update(Request $request, Link $link): RedirectResponse
    {
        abort_unless($link->user_id === $request->user()->id, 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'url' => ['required', 'url', 'max:500'],
            'icon' => ['nullable', 'string', 'max:50'],
        ]);

        $link->update($validated);

        return redirect()
            ->route('links.index')
            ->with('success', 'Link berhasil diupdate!');
    }

    /**
     * Remove the specified link.
     */
    public function destroy(Request $request, Link $link): RedirectResponse
    {
        abort_unless($link->user_id === $request->user()->id, 403);

        $link->delete();

        return redirect()
            ->route('links.index')
            ->with('success', 'Link berhasil dihapus!');
    }

    /**
     * Toggle the active status of a link.
     */
    public function toggle(Request $request, Link $link): RedirectResponse
    {
        abort_unless($link->user_id === $request->user()->id, 403);

        $link->update(['is_active' => !$link->is_active]);

        return back()->with('success', 'Status link berhasil diubah!');
    }

    /**
     * Reorder links via AJAX.
     */
    public function reorder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'string'],
        ]);

        foreach ($validated['ids'] as $index => $id) {
            $request->user()
                ->links()
                ->where('id', $id)
                ->update(['sort_order' => $index]);
        }

        return back()->with('success', 'Urutan link berhasil diubah!');
    }
}
