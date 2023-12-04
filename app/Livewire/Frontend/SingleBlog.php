<?php

namespace App\Livewire\Frontend;

use App\Models\Blogs;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class SingleBlog extends Component
{
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $blog = Blogs::where('id', $this->id)->first();
        $title = $blog->title;
        $discription = $blog->discription;
        $image = $blog->image;
        $url = url()->full();
        return view('livewire.frontend.single-blog', compact('title','url','image','discription','blog'));
    }
}
