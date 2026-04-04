@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10 border-r">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-7xl font-bold text-gray-800">Альбом каталог</h1>

            <a href="{{ route('albums.create') }}"
               class="bg-red-600 text-black px-10 py-13 rounded-lg p-2">
                + Добавить альбом
            </a>
        </div>

        @if($albums->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($albums as $album)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                        @if($album->cover_url)
                            <img src="{{ $album->cover_url }}"
                                 alt="{{ $album->title }}"
                                 class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500">
                                Нет изображения
                            </div>
                        @endif

                        <div class="p-5">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                {{ $album->title }}
                            </h2>

                            <p class="text-gray-600 mb-2">
                                <span class="font-semibold">Артист:</span>
                                {{ $album->artist ?? 'Unknown' }}
                            </p>

                            <p class="text-gray-500 text-sm mb-4 line-clamp-3">
                                {{ $album->description ?? 'No description available.' }}
                            </p>

                            <div class="flex gap-3">
                                <a href="{{ route('albums.edit', $album) }}"
                                   class="bg-red-500 hover:bg-red-600 text-black px-4 py-2 ">
                                    Изменить
                                </a>

                                <form method="POST"
                                      action="{{ route('albums.destroy', $album) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Delete this album?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $albums->links() }}
            </div>
        @else
            <div class="bg-white rounded-xl shadow p-10  text-gray-500">
                Альбомов нет. Добавь свой первый альбом
            </div>
        @endif
    </div>
@endsection
