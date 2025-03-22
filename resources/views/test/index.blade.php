@extends('layouts.app')

@section('content')
    <section class="pt-30" x-data="{ activeTab: 'theme' }">
        <div class="container">
            <div class="flex flex-col items-center gap-4">
                <div class="sm:hidden">
                    <label for="Tab" class="sr-only">Tab</label>
                    <select id="Tab" class="w-full rounded-md border-gray-200" x-model="activeTab">
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="hidden sm:block">
                    <nav class="flex gap-15" aria-label="Tabs">
                        @foreach($categories as $category)
                            <a href="#"
                               @click.prevent="activeTab = '{{ $category->slug }}'"
                               class="rounded-lg p-2 text-md font-semibold text-black hover:bg-orange-400 hover:text-white"
                               :class="{ 'bg-orange-400 text-white': activeTab === '{{ $category->slug }}' }">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </nav>
                </div>

                <hr class="w-full"/>
            </div>
        </div>

        <section class="py-10">
            <div class="container">
                @foreach($categories as $category)
                    <div x-show="activeTab === '{{ $category->slug }}'" class="flex flex-wrap items-center justify-center gap-6 lg:gap-4">

                        @foreach($category->tests as $test)
                            <div class="flex flex-col gap-4 p-5 w-full md:max-w-[280px] items-center text-center bg-gray-200 rounded-xl">
                                <h3 class="text-xl font-semibold">{{ $test->title }}</h3>
                                <p>{{ $test->duration }} минут</p>
                                <a href="{{ url('/test/' . $test->id) }}" class="px-3 py-2 sm:px-5 sm:py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black w-full">
                                    Пройти тест
                                </a>
                            </div>
                        @endforeach

                        @foreach($category->children as $childCategory)
                            <div class="w-full">
                                <h4 class="text-lg font-semibold text-center mt-4">{{ $childCategory->name }}</h4>
                                <div class="flex flex-wrap items-center justify-center gap-6 lg:gap-4">
                                    @foreach($childCategory->tests as $test)
                                        <div class="flex flex-col gap-4 p-5 w-full md:max-w-[280px] items-center text-center bg-gray-200 rounded-xl">
                                            <h3 class="text-xl font-semibold">{{ $test->title }}</h3>
                                            <a href="{{ url('/test/' . $test->id) }}" class="px-3 py-2 sm:px-5 sm:py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black w-full">
                                                Пройти тест
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endforeach
            </div>
        </section>
    </section>
@endsection
