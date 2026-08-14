<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateArtistProfileRequest;
use App\Models\ArtistProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminArtistController extends Controller
{
    private function getOrCreateArtist(): ArtistProfile
    {
        return ArtistProfile::first() ?? ArtistProfile::create([
            'name' => 'Gus Tut',
            'slug' => 'gus-tut',
            'photo' => '',
            'biography' => '',
            'specialization' => '',
            'experience_years' => 0,
            'is_featured' => true,
            'is_visible' => true,
        ]);
    }

    public function edit(): View
    {
        return view('admin.artist-profile.edit', [
            'pageTitle' => 'Artist Profile',
            'artist' => $this->getOrCreateArtist(),
        ]);
    }

    public function update(UpdateArtistProfileRequest $request): RedirectResponse
    {
        $artist = $this->getOrCreateArtist();

        $data = $request->validated();

        if (isset($data['photo']) && $data['photo'] instanceof \Illuminate\Http\UploadedFile) {
            if ($artist->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($artist->photo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($artist->photo);
            }
            $data['photo'] = $data['photo']->store('artists', 'public');
        } else {
            unset($data['photo']);
        }

        $artist->update($data);

        return redirect()->route('admin.artist-profile.edit')
            ->with('success', 'Artist profile updated successfully.');
    }
}
