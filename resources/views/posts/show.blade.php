@extends('layouts.app')

@section('content')
    <section class="py-10 bg-white">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="flex flex-col lg:flex-row gap-6">

                <aside class="hidden lg:block w-1/5">
                    <div class="sticky top-20 space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center border border-gray-100">
                            <p class="mb-3 text-[10px] uppercase tracking-tighter text-gray-400 font-semibold">
                                {{ __('messages.advertisement') }}
                            </p>

                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-5174957124050822"
                                 data-ad-slot="5609803250"
                                 data-ad-format="auto"
                                 data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                    </div>
                </aside>

                <article class="w-full lg:w-3/5 space-y-6">
                    <h2 class="text-3xl font-semibold text-gray-900">{{ $post->title }}</h2>

                    @if ($post->cover)
                        <div class="w-full h-80 sm:h-96 overflow-hidden rounded-lg shadow-md">
                            <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}" class="w-full h-full object-cover object-center">
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-gray-700">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold">{{ __('messages.date_of_publication') }}</span>
                            <span class="text-sm text-white bg-blue-950 px-3 py-1 rounded-full">
                                {{ \Carbon\Carbon::parse($post->published_at)->format('d-m-Y') }}
                            </span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">#{{ $post->meta_keywords }}</span>
                        </div>
                    </div>

                    <div class="prose max-w-none text-gray-800 mt-6">
                        {!! $post->content !!}
                    </div>
                </article>

                <aside class="hidden lg:block w-1/5">
                    <div class="sticky top-20 space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm text-center border border-gray-100">
                            <p class="mb-3 text-[10px] uppercase tracking-tighter text-gray-400 font-semibold">
                                {{ __('messages.advertisement') }}
                            </p>

                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-5174957124050822"
                                 data-ad-slot="5609803250"
                                 data-ad-format="auto"
                                 data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </section>
@endsection