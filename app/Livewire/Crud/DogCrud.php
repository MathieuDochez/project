<?php

namespace App\Livewire\Crud;

use App\Models\Dog;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DogCrud extends Component
{
    use WithFileUploads, WithPagination;

    public $dogId, $name, $breed, $age, $weight, $color, $owner, $additional_info;
    public $image;
    public $currentImagePath;
    public $isEditing = false;

    public function mount()
    {

    }


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
            'image' => 'nullable|image|max:5024', // Max 5MB
        ]);

        $dog = Dog::create([
            'name' => $this->name,
            'breed' => $this->breed,
            'age' => $this->age,
            'weight' => $this->weight,
            'color' => $this->color,
            'owner' => $this->owner,
            'additional_info' => $this->additional_info,
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->handleImageUpload($dog);
            $dog->update(['image_path' => $imagePath]);
        }

        $this->resetForm();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Dog successfully added!',
        ]);
        $this->dispatch('dog-added');
    }

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
        $this->currentImagePath = $dog->image_path;
    }

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
            'image' => 'nullable|image|max:5024', // Max 5MB
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

        if ($this->image) {
            if ($dog->image_path) {
                $this->deleteImage($dog->image_path);
            }

            $imagePath = $this->handleImageUpload($dog);
            $dog->update(['image_path' => $imagePath]);
        }

        $this->resetForm();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Dog successfully updated!',
        ]);
        $this->dispatch('dog-updated');
    }

    public function deleteDog(Dog $dog)
    {
        if ($dog->image_path) {
            $this->deleteImage($dog->image_path);
        }

        $dog->delete();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Dog successfully deleted!',
        ]);
    }

    public function removeCurrentImage()
    {
        if ($this->currentImagePath && $this->dogId) {
            $dog = Dog::find($this->dogId);

            if ($dog && $dog->image_path) {
                $this->deleteImage($dog->image_path);
                $dog->update(['image_path' => null]);
                $this->currentImagePath = null;

                $this->dispatch('swal:toast', [
                    'background' => 'success',
                    'html' => 'Image removed successfully!',
                ]);
            }
        }
    }

    private function generateSafeFilename($dog, $extension)
    {
        // Create a safe filename using dog ID and sanitized name
        $safeName = Str::slug($dog->name, '-'); // Converts "Golden Retriever" to "golden-retriever"
        $timestamp = now()->format('YmdHis'); // Add timestamp for uniqueness

        return "dog-{$dog->id}-{$safeName}-{$timestamp}.{$extension}";
    }

    private function handleImageUpload($dog)
    {
        if ($this->image) {
            if (!Storage::disk('public')->exists('img')) {
                Storage::disk('public')->makeDirectory('img');
            }
            $extension = $this->image->getClientOriginalExtension();

            $filename = $this->generateSafeFilename($dog, $extension);

            $path = $this->image->storeAs('img', $filename, 'public');

            return $path;
        }
        return null;
    }

    private function deleteImage($imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

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
        $this->image = null;
        $this->currentImagePath = null;
        $this->isEditing = false;
        $this->resetValidation();
    }

    #[Layout('layouts.project', ['title' => 'Dog Management', 'description' => 'Manage dogs in the kennel'])]
    public function render()
    {
        return view('livewire.crud.dog-crud', [
            'dogs' => Dog::paginate(10)
        ]);
    }
}
