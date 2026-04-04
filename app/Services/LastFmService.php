<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LastFmService
{
    public function getAlbumInfo(string $title, ?string $artist = null): array
    {
        $response = Http::get('https://ws.audioscrobbler.com/2.0/', [
            'method' => 'album.getinfo',
            'api_key' => config('services.lastfm.key'),
            'album' => $title,
            'artist' => $artist,
            'format' => 'json',
        ]);

        return $response->json();
    }
}
