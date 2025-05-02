@extends('layouts.app')

@section('content')
    <section class="pt-[30px]" x-data="{
    activeTab: '{{ $categories->first()->slug ?? 'saved' }}',
    mistakes: @js($mistakes),
    locale: '{{ app()->getLocale() }}'
}">
        <div class="flex flex-col lg:flex-row gap-6 container mx-auto px-4 lg:px-16">
            <div class="hidden lg:block w-[200px]">
                <p class="text-sm text-center text-gray-500">{{ __('messages.advertisement') }}</p>
                <img src="https://placehold.co/160x600/EEE/31343C" alt="Ad" class="mt-2 rounded mx-auto">
            </div>

            <div class="flex-1">
                <div class="flex flex-col items-center gap-4">
                    <div class="sm:hidden w-full">
                        <label for="Tab" class="sr-only">Tab</label>
                        <select id="Tab" class="w-full rounded-md border-gray-200" x-model="activeTab">
                            @foreach($categories as $category)
                                @if(!$category->parent_id)
                                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                            <option value="errors">{{ __('messages.mistakes') }}</option>
                            <option value="results">{{ __('messages.passage') }}</option>
                        </select>
                    </div>

                    <div class="hidden sm:block w-full">
                        <nav class="flex gap-4 justify-center" aria-label="Tabs">
                            @foreach($categories as $category)
                                @if(!$category->parent_id)
                                    <a href="#" @click.prevent="activeTab = '{{ $category->slug }}'"
                                       class="rounded-lg p-2 text-md font-semibold text-black hover:bg-orange-400 hover:text-white"
                                       :class="{ 'bg-orange-400 text-white': activeTab === '{{ $category->slug }}' }">
                                        {{ $category->name }}
                                    </a>
                                @endif
                            @endforeach
                            <a href="#" @click.prevent="activeTab = 'errors'"
                               class="rounded-lg p-2 text-md font-semibold text-black hover:bg-orange-400 hover:text-white"
                               :class="{ 'bg-orange-400 text-white': activeTab === 'errors' }">
                                {{ __('messages.mistakes') }}
                            </a>
                            <a href="#" @click.prevent="activeTab = 'results'"
                               class="rounded-lg p-2 text-md font-semibold text-black hover:bg-orange-400 hover:text-white"
                               :class="{ 'bg-orange-400 text-white': activeTab === 'results' }">
                                {{ __('messages.passage') }}
                            </a>
                        </nav>
                    </div>

                    <hr class="w-full mt-4"/>
                </div>

                <section class="py-10">
                    @foreach($categories as $category)
                        <div x-show="activeTab === '{{ $category->slug }}'" class="flex flex-wrap justify-center gap-6 lg:gap-4">
                            @foreach($category->tests as $index => $test)
                                <div class="flex flex-col gap-4 p-5 w-full md:max-w-[280px] items-center text-center bg-gray-200 rounded-xl shadow-md">
                                    <h3 class="text-xl font-semibold">{{ $test->title }}</h3>
                                    <p class="text-sm text-gray-600">{{ $test->duration }} {{ __('messages.minutes') }}</p>
                                    <a href="{{ url('/test/' . $test->id) }}" class="px-3 py-2 sm:px-5 sm:py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black w-full mt-4">
                                        {{ __('messages.take_the_test') }}
                                    </a>
                                </div>

                                @if(($index + 1) % 4 === 0)
                                    <div class="w-full text-center my-4">
                                        <p class="text-sm text-gray-500">{{ __('messages.advertisement') }}</p>
                                        <img src="https://placehold.co/728x90/EEE/31343C" alt="Ad Banner" class="mt-2 rounded mx-auto">
                                    </div>
                                @endif
                            @endforeach

                            @foreach($category->children as $childCategory)
                                <div class="w-full mt-6">
                                    <h4 class="text-lg font-semibold text-center">{{ $childCategory->name }}</h4>
                                    <div class="flex flex-wrap justify-center gap-6 lg:gap-4">
                                        @foreach($childCategory->tests as $test)
                                            <div class="flex flex-col gap-4 mt-5 p-5 w-full md:max-w-[280px] items-center text-center bg-gray-200 rounded-xl shadow-md">
                                                <h3 class="text-xl font-semibold">{{ $test->title }}</h3>
                                                <a href="{{ url('/test/' . $test->id) }}" class="px-3 py-2 sm:px-5 sm:py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black w-full mt-4">
                                                    {{ __('messages.take_the_test') }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <div x-show="activeTab === 'errors'" class="flex flex-col items-center gap-6 w-full mt-10">
                        <h2 class="text-xl font-semibold text-center w-full">{{ __('messages.mistakes') }}</h2>

                        <template x-if="mistakes.length === 0">
                            <p class="text-gray-500">{{ __('messages.no_errors') }}</p>
                        </template>

                        <template x-for="mistake in mistakes" :key="mistake.id">
                            <div class="space-y-4 w-full lg:w-[800px] mb-5 border rounded-lg shadow-md bg-gray-50 p-4">
                                <h3 class="text-lg font-medium text-gray-900" x-text="mistake.question.question[locale]"></h3>

                                <template x-if="mistake.question.image">
                                    <img class="w-full rounded" :src="'/storage/' + mistake.question.image" alt="">
                                </template>

                                <div class="flex flex-col gap-2 text-center">
                                    <template x-for="answer in mistake.question.answers" :key="answer.id">
                                        <div class="w-full px-3 py-2 rounded"
                                             :class="answer.is_correct ? 'bg-green-200 font-semibold text-black' : 'bg-gray-200 text-black'"
                                             x-text="answer.answer[locale]">
                                        </div>
                                    </template>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <p class="font-semibold">{{ __('messages.explanation') }}:</p>
                                    <p class="leading-relaxed text-gray-700" x-text="mistake.question.explanation[locale]"></p>

                                    <div class="text-center mt-4">
                                        <a :href="'/test/' + mistake.question.test_id"
                                           class="px-3 py-2 bg-orange-400 text-white rounded-xl max-w-[280px] mx-auto inline-block">
                                            {{ __('messages.retry_test') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                        <div class="mt-10" x-show="activeTab === 'results'">
                            <h2 class="text-xl font-semibold text-center mb-6">{{ __('messages.test_results') }}</h2>

                            <div class="flex flex-wrap justify-center gap-6">
                                @forelse($testResults as $result)
                                    @php
                                        $percentage = round(($result->score / max($result->total, 1)) * 100);
                                        $isSuccess = $percentage >= 90;
                                    @endphp

                                    <div class="flex flex-col items-center p-5 w-full md:max-w-[280px] text-center rounded-xl shadow-md {{ $isSuccess ? 'bg-green-100' : 'bg-red-100' }}">
                                        <h3 class="text-lg font-bold">
                                            {{ $result->test?->title ?? __('messages.test_deleted') }}
                                        </h3>

                                        <p class="text-sm mt-2">
                                            {{ __('messages.test_results') }}: <strong>{{ $result->score }}/{{ $result->total }}</strong>
                                        </p>

                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $result->created_at->format('d.m.Y H:i') }}
                                        </p>

                                        @if ($result->test)
                                            <a href="{{ url('/test/' . $result->test_id) }}"
                                               class="mt-4 px-3 py-2 bg-orange-400 text-white rounded-lg hover:bg-orange-500">
                                                {{ __('messages.retry_test') }}
                                            </a>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-gray-500 text-center w-full">{{ __('messages.no_test_results') }}</p>
                                @endforelse
                            </div>
                        </div>

                </section>
            </div>

            <div class="hidden lg:block w-[200px]">
                <p class="text-sm text-center text-gray-500">{{ __('messages.advertisement') }}</p>
                <img src="https://placehold.co/160x600/EEE/31343C" alt="Ad" class="mt-2 rounded mx-auto">
            </div>
        </div>
    </section>
@endsection
