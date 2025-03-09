<div>
    <h3>Комментарии</h3>

    @foreach ($comments as $comment)
        <div class="mb-3 p-3 border rounded">
            <strong>{{ $comment->user_type === 'Guest' ? 'Гость' : $comment->user->name }}</strong>
            <p>{{ $comment->comment }}</p>
        </div>
    @endforeach

    {{ $comments->links() }}

    <form wire:submit.prevent="addComment" class="mt-4">
        <textarea wire:model="comment" class="form-control" placeholder="Напишите комментарий"></textarea>
        <button type="submit" class="btn btn-success mt-2">Отправить</button>
    </form>
</div>
