<?php

namespace App\Livewire\Frontend;

use App\Models\Blogs;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class Blog extends Component
{
    public function render()
    {
        $blogs = Blogs::get();
        $title = 'Blog';
        $url = url()->full();
        return view('livewire.frontend.blog', compact('title','url','blogs'));
    }
}
