<?php
// app/Livewire/Crud/DogCrud.php

namespace App\Livewire\Crud;

use App\Models\Dog;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DogCrud extends Component
{
    public $dogs = [];
    public $dogId, $name, $breed, $age, $weight, $color, $owner, $additional_info;
    public $isEditing = false;

    // Mount: Initialize the list of dogs
    public function mount()
    {
        $this->dogs = Dog::all();
    }

    // Create a new dog
    public function createDog()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|numeric|min:0.1',
            'weight' => 'required|numeric|min:0.1',
            'color' => 'required|string|max:255',
            'owner' => 'string|max:255',
            'additional_info' => 'nullable|string|max:1000',
        ]);

        Dog::create([
            'name' => $this->name,
            'breed' => $this->breed,
            'age' => $this->age,
            'weight' => $this->weight,
            'color' => $this->color,
            'owner' => $this->owner,
            'additional_info' => $this->additional_info,
        ]);

        // Reset the form and refresh the dog list
        $this->resetForm();
        $this->dogs = Dog::all(); // Refresh the list
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Dog successfully added!',
        ]);
    }

    // Edit an existing dog
    public function editDog(Dog $dog)
    {
        $this->isEditing = true;
        $this->dogId = $dog->id;
        $this->name = $dog->name;
        $this->breed = $dog->breed;
        $this->age = $dog->age;
        $this->weight = $dog->weight;
        $this->color = $dog->color;
        $this->owner = $dog->owner;
        $this->additional_info = $dog->additional_info;
    }

    // Update an existing dog
    public function updateDog()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|numeric|min:0.1',
            'weight' => 'required|numeric|min:0.1',
            'color' => 'required|string|max:255',
            'owner' => 'string|max:255',
            'additional_info' => 'nullable|string|max:1000',
        ]);

        $dog = Dog::find($this->dogId);
        $dog->update([
            'name' => $this->name,
            'breed' => $this->breed,
            'age' => $this->age,
            'weight' => $this->weight,
            'color' => $this->color,
            'owner' => $this->owner,
            'additional_info' => $this->additional_info,
        ]);

        // Reset the form and refresh the dog list
        $this->resetForm();
        $this->dogs = Dog::all(); // Refresh the list
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Dog successfully updated!',
        ]);
    }

    // Delete a dog
    public function deleteDog(Dog $dog)
    {
        $dog->delete();
        $this->dogs = Dog::all(); // Refresh the list
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Dog successfully deleted!',
        ]);
    }

    // Reset form fields
    public function resetForm()
    {
        $this->dogId = null;
        $this->name = '';
        $this->breed = '';
        $this->age = '';
        $this->weight = '';
        $this->color = '';
        $this->owner = '';
        $this->additional_info = '';
        $this->isEditing = false;
    }

    #[Layout('layouts.project', ['title' => 'Dog Management', 'description' => 'Manage dogs in the kennel'])]
    public function render()
    {
        return view('livewire.crud.dog-crud');
    }
}
