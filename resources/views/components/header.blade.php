<header class="fixed top-0 inset-x-0 z-50 bg-white shadow-sm border-b border-gray-100">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex justify-between items-center h-16 sm:h-20">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-orange-500">
                    <path d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 116 0h3a.75.75 0 00.75-.75V15z" />
                    <path d="M8.25 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0zM15.75 6.75a.75.75 0 00-.75.75v11.25c0 .087.015.17.042.248a3 3 0 015.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 00-3.732-10.104 1.837 1.837 0 00-1.47-.725H15.75z" />
                    <path d="M19.5 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                </svg>
                <span class="text-xl font-bold text-gray-800">Авто<span class="text-orange-500">{{ __('messages.school') }}</span></span>
            </a>

            <nav class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="px-4 py-2 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    {{ __('nav.home') }}
                </a>


                <div class="relative group">
                    <button class="group flex items-center gap-1 px-4 py-2 text-gray-700 hover:text-orange-500">
                        {{ __('nav.pdd') }}
                        <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-64 bg-white rounded-md shadow-lg py-2 z-50 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-200 border border-gray-100">
                            <a href="{{ route('pages.show', 'pdd-kr-2024') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-orange-500">
                                {{ __('messages.pdd_2024_title') }}
                            </a>
                            <a href="{{ route('traffic.signs') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-orange-500">
                                {{ __('messages.traffic_signs_title') }}
                            </a>
                            <a href="{{ route('road.markings') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-orange-500">
                                {{ __('messages.road_markings_title') }}
                            </a>
                            <a href="{{ route('fines') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-orange-500">
                                {{ __('messages.fines') }}
                            </a>
                    </div>
                </div>



                <a href="{{ route('posts.index') }}" class="px-4 py-2 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                    </svg>
                    {{ __('nav.blog') }}
                </a>
                <a href="{{ route('tests.index') }}" class="px-4 py-2 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ __('nav.tests') }}
                </a>
                <a href="{{ route('faq') }}" class="px-4 py-2 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    {{ __('nav.faq') }}
                </a>
            </nav>

            <div class="hidden lg:flex items-center gap-2">
                <div class="relative group">
                    <button class="flex items-center gap-1 px-3 py-2 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-28 bg-white rounded-md shadow-lg py-1 z-50 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-200 border border-gray-100">
                        <a href="{{ route('locale.switch', 'ru') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-orange-500">Русский</a>
                        <a href="{{ route('locale.switch', 'kg') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-orange-500">Кыргызский</a>
                    </div>
                </div>

            @auth
                    <div class="relative group">
                        <button class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200">
                            <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-200 border border-gray-100">
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-orange-500">
                                    {{ __('nav.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <a href="{{ route('tests.index') }}" class="px-4 py-2 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition-all duration-200 shadow-sm hover:shadow-md">
                        {{ __('nav.start_test') }}
                    </a>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200">
                        {{ __('nav.login') }}
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition-all duration-200 shadow-sm hover:shadow-md">
                        {{ __('nav.register') }}
                    </a>
                @endguest
            </div>

            <!-- Мобильное меню -->
            <div class="lg:hidden flex items-center">
                <button id="mobileMenuToggle" class="p-2 rounded-md text-gray-700 hover:text-orange-500 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Мобильное меню (выпадающее) -->
    <div id="mobileMenu" class="lg:hidden hidden bg-white shadow-lg border-t border-gray-100">
        <div class="container mx-auto px-4 py-3">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('home') }}" class="px-4 py-3 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200 flex items-center gap-3 border-b border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    {{ __('nav.home') }}
                </a>
                <a href="#" class="px-4 py-3 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200 flex items-center gap-3 border-b border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ __('nav.pdd') }}
                </a>
                <a href="{{ route('posts.index') }}" class="px-4 py-3 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200 flex items-center gap-3 border-b border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                    </svg>
                    {{ __('nav.blog') }}
                </a>
                <a href="{{ route('tests.index') }}" class="px-4 py-3 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200 flex items-center gap-3 border-b border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ __('nav.tests') }}
                </a>
                <a href="{{ route('faq') }}" class="px-4 py-3 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200 flex items-center gap-3 border-b border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    {{ __('nav.faq') }}
                </a>
            </div>

            <div class="mt-4 pt-4 border-t border-gray-100">
                @auth
                    <div class="flex items-center justify-between px-4 py-3">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium text-gray-700">{{ Auth::user()->name }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-orange-500 hover:text-orange-600 font-medium">
                                {{ __('nav.logout') }}
                            </button>
                        </form>
                    </div>
                    <a href="{{ route('tests.index') }}" class="block w-full mt-3 px-4 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition-all duration-200 text-center">
                        {{ __('nav.start_test') }}
                    </a>
                @endauth

                @guest
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('login') }}" class="px-4 py-3 text-gray-700 hover:text-orange-500 font-medium rounded-lg transition-all duration-200 border border-gray-200 text-center">
                            {{ __('nav.login') }}
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition-all duration-200 text-center">
                            {{ __('nav.register') }}
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');

            // Анимация иконки меню
            const isOpen = !mobileMenu.classList.contains('hidden');
            if (isOpen) {
                mobileMenuToggle.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                `;
            } else {
                mobileMenuToggle.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                `;
            }
        });
    });
</script>
