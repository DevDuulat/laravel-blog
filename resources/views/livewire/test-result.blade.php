<div x-data="{ activeCategory: null }">
    <!-- Категории -->
    <div class="flex gap-6 overflow-x-auto pb-4">
        @foreach($categories as $category)
            <a href="#"
               @click.prevent="activeCategory = '{{ $category->slug }}'"
               class="p-3 font-semibold text-black rounded-lg transition-colors duration-200 hover:bg-orange-400 hover:text-white"
               :class="{ 'bg-orange-400 text-white': activeCategory === '{{ $category->slug }}' }">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <!-- Тесты из выбранной категории -->
    <div x-show="activeCategory" wire:ignore.self class="mt-5">
        <h3 class="text-2xl font-semibold mb-6">
            Тесты из категории: <span x-text="activeCategory" class="font-bold text-orange-400"></span>
        </h3>

        <div x-show="activeCategory" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tests as $test)
                <div class="flex flex-col gap-4 p-6 bg-gray-200 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $test->title }}</h3>
                    <p class="text-gray-600">{{ $test->description }}</p>
                    <a href="{{ route('test.show', $test->slug) }}" class="px-4 py-2 text-white font-semibold border border-orange-400 bg-orange-400 rounded-xl hover:bg-white hover:text-black transition">
                        Пройти тест
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
