<button wire:click="toggleSave"
        class="bg-orange-400 text-white font-semibold rounded-lg px-5 py-3 border border-orange-400
    hover:bg-white hover:text-black transition duration-300 ease-in-out lg:ml-44 mt-6">
    {{ $isSaved ? 'Удалить из сохраненных' : 'Сохранить вопрос' }}
</button>
