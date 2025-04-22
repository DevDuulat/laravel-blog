@extends('layouts.app')

@section('content')
    <section class="pt-10">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-2/3 space-y-6">
                    @forelse($pages as $page)
                        <a href="{{ route('pages.show', ['locale' => app()->getLocale(), 'slug' => $page->getTranslatedSlug()]) }}" class="block">
                            <div class="flex flex-col lg:flex-row bg-white p-6 rounded-lg shadow-md transition-transform duration-200 ease-in-out hover:-translate-y-1 hover:shadow-lg">
                                <div class="w-full h-48 lg:hidden">
                                    <img src="{{ asset('storage/' . $page->cover) }}" alt="" class="object-cover w-full h-full rounded-lg"/>
                                </div>
                                <div class="flex flex-col gap-4 flex-1">
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $page->title }}</h3>
                                    <p class="text-gray-600 text-sm">{{ \Str::limit(strip_tags($page->content), 150) }}</p>
                                </div>
                                <div class="w-1/2 hidden lg:block">
                                    <img src="{{ asset('storage/' . $page->cover) }}" alt="" class="object-cover w-full h-full rounded-lg">
                                </div>
                            </div>
                        </a>

                    @empty
                        <div class="bg-white p-6 rounded-lg shadow-md text-gray-600 text-center">
                            Пока нет доступных постов.
                        </div>
                    @endforelse

                </div>

                <div class="w-full md:w-1/3 hidden md:block space-y-4">
                    <div class="bg-gray-100 h-48 rounded-lg shadow-md">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
