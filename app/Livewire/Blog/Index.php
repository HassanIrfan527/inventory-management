<?php

namespace App\Livewire\Blog;

use App\Services\BlogService;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.public')]
#[Title('Blog - Folio')]
class Index extends Component
{
    public Collection $posts;

    public function mount(BlogService $blog): void
    {
        $this->posts = $blog->getAllPosts();
    }

    public function render()
    {
        return view('livewire.blog.index');
    }
}
