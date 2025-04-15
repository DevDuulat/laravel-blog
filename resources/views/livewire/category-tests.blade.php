<div x-data="{ activeCategory: null }">
    <div class="flex gap-15">
        @foreach($categories as $category)
            <a href="#"
               @click.prevent="activeCategory = '{{ $category->slug }}'"
               class="p-3 font-semibold text-black hover:bg-orange-400 hover:text-white rounded-lg"
               :class="{ 'bg-orange-400 text-white': activeCategory === '{{ $category->slug }}' }">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div x-show="activeCategory" wire:ignore.self>
        <div class="mt-5">
            <h3 class="text-2xl font-semibold mb-4">Тесты из категории: <span x-text="activeCategory"></span></h3>
            <div x-show="activeCategory" class="flex flex-wrap gap-4">
                @foreach($tests as $test)
                    <div class="flex flex-col gap-4 p-5 w-full md:max-w-[280px] items-center text-center bg-gray-200 rounded-xl">
                        <h3 class="text-xl font-semibold">{{ $test->title }}</h3>
                        <p>{{ $test->description }}</p>
                        <a href="{{ route('test.show', $test->slug) }}" class="px-3 py-2 sm:px-5 sm:py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black w-full">Пройти тест</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
