<?php

namespace App\Livewire;

use App\Models\Dog;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class DogGallery extends Component
{
    use WithPagination;



    #[Layout('layouts.project', ['title' => '', 'description' => 'Dog kennel Item'])]
    public function render()
    {
        return view('livewire.dog-gallery', [
            'dogs' => Dog::paginate(8), // Adjust the number of items per page as needed
        ]);
    }
}
