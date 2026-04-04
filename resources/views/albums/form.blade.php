@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-600 py-10 px-6">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">
                {{ isset($album) ? ' ИЗМЕНИТЬ АЛЬБОМ' : 'ДОБАВИТЬ АЛЬБОМ' }}
            </h1>

            <form method="POST"
                  action="{{ isset($album)
                ? route('albums.update', $album)
                : route('albums.store') }}">
                @csrf
                @isset($album)
                    @method('PUT')
                @endisset

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        НАЗВАНИЕ АЛЬБОМА
                    </label>
                    <input type="text"
                           name="title"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                           value="{{ old('title', $album->title ?? '') }}">
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        АРТИСТ
                    </label>
                    <input type="text"
                           name="artist"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                           value="{{ old('artist', $album->artist ?? '') }}">
                </div>

                <button type="button"
                        onclick="fetchAlbum()"
                        class="bg-red-600 text-black px-5 py-3 rounded-lg transition mb-6 mt-2 p-2">
                    ПОИСК В last.fm
                </button>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        ОПИСАНИЕ
                    </label>
                    <textarea name="description"
                              rows="5"
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('description', $album->description ?? '') }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        URL ИЗОБРАЖЕНИЕ
                    </label>
                    <input type="text"
                           name="cover_url"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                           value="{{ old('cover_url', $album->cover_url ?? '') }}">
                </div>

                <button type="submit"
                        class="bg-red-600 text-black px-6 py-3 rounded-lg shadow transition mb-5">
                    СОХРАНИТЬ
                </button>
            </form>
        </div>
    </div>

    <script>
        async function fetchAlbum() {
            const title = document.querySelector('[name="title"]').value;
            const artist = document.querySelector('[name="artist"]').value;

            if (!title || !artist) {
                alert('Введите title и artist');
                return;
            }

            const response = await fetch('{{ route('albums.fetch') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ title, artist })
            });

            const data = await response.json();

            document.querySelector('[name="artist"]').value = data.artist || '';
            document.querySelector('[name="description"]').value = data.description || '';
            document.querySelector('[name="cover_url"]').value = data.cover_url || '';
        }
    </script>
@endsection
