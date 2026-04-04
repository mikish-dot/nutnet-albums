<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumLog;
use App\Services\LastFmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->paginate(10);

        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        return view('albums.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'cover_url' => 'nullable|url',
        ]);

        $album = Album::create($validated);

        AlbumLog::create([
            'album_id' => $album->id,
            'user_id' => Auth::id(),
            'action' => 'created',
        ]);

        return redirect()->route('albums.index');
    }

    public function edit(Album $album)
    {
        return view('albums.form', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'cover_url' => 'nullable|url',
        ]);

        $album->update($validated);

        AlbumLog::create([
            'album_id' => $album->id,
            'user_id' => Auth::id(),
            'action' => 'updated',
        ]);

        return redirect()->route('albums.index');
    }

    public function destroy(Album $album)
    {
        AlbumLog::create([
            'album_id' => $album->id,
            'user_id' => Auth::id(),
            'action' => 'deleted',
        ]);

        $album->delete();

        return redirect()->route('albums.index');
    }

    public function fetch(Request $request, LastFmService $service)
    {
        $data = $service->getAlbumInfo(
            $request->title,
            $request->artist
        );

        $images = collect(data_get($data, 'album.image', []));
        $cover = optional($images->last())['#text'] ?? '';

        return response()->json([
            'artist' => data_get($data, 'album.artist', ''),
            'description' => strip_tags(
                data_get($data, 'album.wiki.summary', '')
            ),
            'cover_url' => $cover,
        ]);
    }
}
