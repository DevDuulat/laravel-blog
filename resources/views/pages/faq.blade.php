@extends('layouts.app')

@section('content')
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 lg:px-16 flex flex-col items-center">
            <h3 class="text-center text-3xl font-semibold mb-8 text-gray-800">  {{ __('messages.help_faq') }}</h3>

            <div class="w-full lg:w-3/4 space-y-4">
                @forelse($faqs as $faq)
                    <details class="group bg-white rounded-lg shadow-md overflow-hidden">
                        <summary class="flex justify-between items-center p-4 cursor-pointer text-gray-800 hover:bg-gray-100 transition-all">
                            <h4 class="font-medium text-lg">{{ $faq->question }}</h4>
                            <svg class="size-5 shrink-0 transition duration-300 group-open:-rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <p class="p-4 text-gray-700">{!! nl2br(e($faq->answer)) !!}</p>
                    </details>
                @empty

                    <div class="bg-white p-6 rounded-lg shadow-md text-gray-600 text-center">
                        {{ __('messages.no_faqs_yet') }}
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
