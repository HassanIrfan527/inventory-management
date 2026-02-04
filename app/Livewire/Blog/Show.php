<?php

namespace App\Livewire\Blog;

use App\Services\BlogService;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.public')]
class Show extends Component
{
    public string $slug;

    public array $post = [];

    public Collection $relatedPosts;

    public function mount(string $slug, BlogService $blog): void
    {
        $this->slug = $slug;
        $this->post = $blog->getPost($slug) ?? [];
        $this->relatedPosts = $blog->getRelatedPosts($slug, 3);

        if (empty($this->post)) {
            abort(404, 'Blog post not found.');
        }
    }

    public function title(): string
    {
        return ($this->post['title'] ?? 'Blog').' - '.config('app.name').' Blog';
    }

    public function render()
    {
        return view('livewire.blog.show');
    }
}
