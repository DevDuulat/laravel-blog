@extends('layouts.app')

@section('content')
    <section class="relative z-10 pt-10" x-data="{ activeCategory: 'all' }">
        <div class="container mx-auto px-4 lg:px-16">

            {{-- 🔹 Кнопки категорий --}}
            <div class="flex flex-wrap gap-3 mb-8">
                <button @click="activeCategory = 'all'"
                        class="px-4 py-2 rounded transition"
                        :class="activeCategory === 'all' ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200'">
                    {{ __('messages.all') }}
                </button>

                @foreach ($subcategories as $subcategory)
                    <button @click="activeCategory = '{{ $subcategory->id }}'"
                            class="px-4 py-2 rounded transition"
                            :class="activeCategory === '{{ $subcategory->id }}' ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200'">
                        {{ $subcategory->getTranslation('name', app()->getLocale()) }}
                    </button>
                @endforeach
            </div>

            {{-- 🔹 Все дорожные знаки (с пагинацией) --}}
            <div x-show="activeCategory === 'all'" x-cloak x-transition>
                <h2 class="text-2xl font-semibold mb-4">{{ __('messages.all_road_signs') }}</h2>

                <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-6">
                    @foreach ($contents as $item)
                        @php
                            $title = $item->getTranslatedTitle();
                            $slug = $item->getTranslatedSlug();
                            $content = $item->getTranslatedContent();
                            $image = 'storage/' . $item->cover;
                            $short = \Illuminate\Support\Str::limit(strip_tags($content), 100);
                        @endphp

                        @if ($slug)
                            <a href="{{ route('pages.show', ['slug' => $slug]) }}"
                               class="block bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                                <div class="w-full min-h-[200px] overflow-hidden rounded-lg">
                                    <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-full h-full object-contain">
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $title }}</h3>
                                    <p class="text-sm text-gray-600">{{ $short }}</p>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>

            </div>

            {{-- 🔹 По подкатегориям --}}
            @foreach ($subcategories as $subcategory)
                <div x-show="activeCategory === '{{ $subcategory->id }}'" x-cloak x-transition>
                    <h2 class="text-2xl font-semibold mb-4">
                        {{ $subcategory->getTranslation('name', app()->getLocale()) }}
                    </h2>

                    <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-6">
                        @foreach ($contents->where('category_id', $subcategory->id) as $item)
                            @php
                                $title = $item->getTranslatedTitle();
                                $slug = $item->getTranslatedSlug();
                                $content = $item->getTranslatedContent();
                                $image = 'storage/' . $item->cover;
                                $short = \Illuminate\Support\Str::limit(strip_tags($content), 100);
                            @endphp

                            @if ($slug)
                                <a href="{{ route('pages.show', ['slug' => $slug]) }}"
                                   class="block bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                                    <div class="aspect-square w-full overflow-hidden">
                                        <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $title }}</h3>
                                        <p class="text-sm text-gray-600">{{ $short }}</p>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
