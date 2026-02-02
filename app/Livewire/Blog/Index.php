<?php

namespace App\Livewire\Blog;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.public')]
#[Title('Blog - Kinetic Hub')]
class Index extends Component
{
    public $posts = [
        [
            'id' => 1,
            'title' => 'The Future of Inventory Management is Here',
            'excerpt' => 'Discover how AI and machine learning are revolutionizing the way businesses track stock and predict demand.',
            'category' => 'Industry Trends',
            'author' => 'Sarah Johnson',
            'date' => 'Oct 24, 2025',
            'read_time' => '5 min read',
            'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'featured' => true,
        ],
        [
            'id' => 2,
            'title' => 'Scaling Your E-commerce Business: A Guide',
            'excerpt' => 'Practical tips and strategies for taking your online store from a side hustle to a global brand.',
            'category' => 'Growth',
            'author' => 'Mike Chen',
            'date' => 'Oct 22, 2025',
            'read_time' => '8 min read',
            'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'featured' => false,
        ],
        [
            'id' => 3,
            'title' => 'Understanding Supply Chain Resilience',
            'excerpt' => 'Why building a robust supply chain is more important than ever in today\'s volatile market.',
            'category' => 'Logistics',
            'author' => 'Emma Davis',
            'date' => 'Oct 20, 2025',
            'read_time' => '6 min read',
            'image' => 'https://images.unsplash.com/photo-1494412574643-35d324688125?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'featured' => false,
        ],
        [
            'id' => 4,
            'title' => '5 Tools Every Warehouse Manager Needs',
            'excerpt' => 'Top software and hardware solutions to streamline operations and boost efficiency.',
            'category' => 'Tools',
            'author' => 'James Wilson',
            'date' => 'Oct 18, 2025',
            'read_time' => '4 min read',
            'image' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'featured' => false,
        ],
        [
            'id' => 5,
            'title' => 'The Psychology of Pricing',
            'excerpt' => 'How to price your products to maximize sales without devaluing your brand.',
            'category' => 'Sales',
            'author' => 'Lisa Wong',
            'date' => 'Oct 15, 2025',
            'read_time' => '7 min read',
            'image' => 'https://images.unsplash.com/photo-1559526324-4b87b5d49e6f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'featured' => false,
        ],
    ];

    public function render()
    {
        return view('livewire.blog.index');
    }
}
