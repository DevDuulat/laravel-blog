<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use TomatoPHP\FilamentCms\Models\Comment;
use TomatoPHP\FilamentCms\Models\Post;

class PostComments extends Component
{
    use WithPagination;

    public $post;
    public $comment;
    public $parent_id = null;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function addComment()
    {
        $this->validate([
            'comment' => 'required|string|min:3',
        ]);

        Comment::create([
            'comment' => $this->comment,
            'content_id' => $this->post->id,
            'content_type' => Post::class,
            'parent_id' => $this->parent_id,
            'user_id' => Auth::id(),
            'user_type' => Auth::check() ? get_class(Auth::user()) : 'Guest',
            'is_active' => true,
        ]);

        $this->comment = '';
        $this->resetPage();
        $this->dispatch('commentAdded');

    }

    public function render()
    {
        return view('livewire.post-comments', [
            'comments' => Comment::where('content_id', $this->post->id)
                ->whereNull('parent_id')
                ->latest()
                ->paginate(10),
        ]);
    }
}
