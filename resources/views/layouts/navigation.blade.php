<nav x-data="{ open: false }" class="bg-white shadow-md border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <div class="flex items-center gap-10">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('albums.index') }}" class="transition hover:scale-105 duration-200">
                        <x-application-logo class="block h-9 w-auto fill-current text-indigo-600" />
                    </a>
                </div>

                <div class="hidden sm:flex items-center space-x-6">
                    <a href="{{ route('albums.index') }}"
                       class="{{ request()->routeIs('albums.*') ? 'text-indigo-600' : 'text-gray-900' }} hover:text-indigo-600 font-semibold transition duration-200">
                        ALBUMS
                    </a>
                </div>
            </div>


            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}"
                       class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200 px-4 py-2 rounded-lg hover:bg-gray-100">
                        ВОЙТИ
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-red-600 text-black px-5 py-2 rounded-lg hover:bg-indigo-700 transition-all duration-200 shadow-md font-medium p-2">
                        РЕГИСТРАЦИЯ
                    </a>
                @endguest

                    @auth
                        <div class="flex items-center space-x-4 shrink-0">
        <span class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-semibold text-gray-800 whitespace-nowrap">
            {{ Auth::user()->name }}
        </span>

                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-red-500 text-black text-sm font-semibold rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-200 whitespace-nowrap">
                                    Выйти
                                </button>
                            </form>
                        </div>
                    @endauth
            </div>
        </div>
    </div>
</nav>
