@extends('layouts.app')

@section('content')
    <section class="py-10 relative mt-20 sm:mb-0">
    <div class="container flex items-center justify-between ">
        <div class="flex flex-col gap-6 text-center sm:text-start">
            <h1 class="text-3xl font-bold sm:text-5xl">Проверьте свои знания ПДД онлайн!</h1>

            <p class="text-lg sm:text-2xl">
                Проверьте свои знания ПДД онлайн! <br/>
                Станьте уверенным водителем с нашими тестами и справочником
            </p>
            <div class="flex justify-center sm:justify-start gap-2 sm:gap-4">
                <a
                    href="сategories-test.html"
                    class=" px-3 py-2  sm:px-5 sm:py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black"
                >Начать тест</a
                >
                <a
                    href="posts.html"
                    class="px-3 py-2  sm:px-5 sm:py-2  text-black font-semibold border border-orange-400 rounded-xl hover:bg-orange-400 hover:text-white "
                >Читать блог</a
                >
            </div>
        </div>
        <div>
            <img src="{{ asset('img/car.png') }}" alt="car" class="w-[800px] h-auto hidden sm:block"/>
        </div>
    </div>
    </section>

    <section class="py-10 relative mt-20 sm:mb-0">
        <section class="py-15 bg-gray-200">
            <div class="container  gap-6">
                <h2 class="text-center mb-10 text-2xl font-semibold">ПДД КР 2025</h2>
                <div class=" flex flex-col sm:flex-row flex-wrap items-center justify-center md:justify-around gap-5 xl:gap-1 ">
                    <div class="flex flex-col gap-4 p-5 max-w-[280px] min-h-[250px] w-full text-center bg-white rounded-xl">
                        <h2 class="text-md font-semibold ">ПДД КР 2024</h2>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Culpa sit rerum incidunt, a
                            consequuntur
                            recusandae</p>
                        <a href="#"
                           class="px-3 py-2  sm:px-5 sm:py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black">Перейти</a>
                    </div>
                    <div class="flex flex-col gap-4 p-5 max-w-[280px] min-h-[250px] w-full text-center bg-white rounded-xl">
                        <h2 class="text-md font-semibold ">Дорожные знаки</h2>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Culpa sit rerum incidunt, a
                            consequuntur
                            recusandae</p>
                        <a href="#"
                           class="px-3 py-2  sm:px-5 sm:py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black">Перейти</a>
                    </div>
                    <div class="flex flex-col gap-4 p-5 max-w-[280px] min-h-[250px] w-full text-center bg-white rounded-xl">
                        <h2 class="text-md font-semibold ">Дорожная разметка</h2>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Culpa sit rerum incidunt, a
                            consequuntur
                            recusandae</p>
                        <a href="#"
                           class="px-3 py-2  sm:px-5 sm:py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black">Перейти</a>
                    </div>
                    <div class="flex flex-col gap-4 p-5 max-w-[280px] min-h-[250px] w-full text-center bg-white rounded-xl">
                        <h2 class="text-md font-semibold ">Основные положения по допуску ТС к эксплуатации
                            ПДД по темам</h2>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. </p>
                        <a href="#"
                           class="px-3 py-2   sm:px-5 sm:py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black">Перейти</a>
                    </div>
                </div>

            </div>

        </section>
        <section class="py-15">
            <div class="container flex flex-col gap-6">
                <h3 class="text-center text-3xl mb-5 font-semibold">Блог новостей</h3>
                <div class="flex flex-wrap items-center justify-around gap-5 lg:gap-1">
                    @foreach ($posts as $post)
                        <div class="flex flex-col gap-4 p-5 w-full md:max-w-[280px] items-center text-center bg-gray-200 rounded-xl">
                            <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}" class="w-full h-auto rounded">
                            <h3 class="text-2xl">{{ $post->title }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 150, '...') }}</p>

                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($post->published_at)->format('d.m.Y') }}</p>
                            <a href="{{ route('posts.show', $post->slug) }}"
                               class="px-3 py-2 sm:px-5 sm:py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black w-full">
                                Посмотреть
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="flex items-center justify-around gap-4 mt-5">
                    <a href="{{ route('posts.index') }}"
                       class="px-3 py-2 sm:px-5 sm:py-2 text-center text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black w-50">
                        Посмотреть все
                    </a>
                </div>
            </div>
        </section>


        <section class="py-20 bg-gray-200">
            <div class="container flex flex-col items-center justify-around gap-4">
                <h3 class="text-center text-3xl mb-5">Справка FAQ</h3>
                <div class="space-y-4 w-full lg:w-200">
                    @foreach($faqs as $faq)
                        <details class="group [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex cursor-pointer items-center justify-between gap-1.5 rounded-lg bg-gray-50 p-4 text-gray-900">
                                <h2 class="font-medium">{{ $faq->question }}</h2>
                                <svg class="size-5 shrink-0 transition duration-300 group-open:-rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </summary>
                            <p class="mt-4 px-4 leading-relaxed text-gray-700">
                                {!! nl2br(e($faq->answer)) !!} <!-- Форматирование текста с переносами строк -->
                            </p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

@endsection
