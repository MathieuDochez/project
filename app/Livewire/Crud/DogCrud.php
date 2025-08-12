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
    public $image; // For file upload
    public $currentImagePath; // To display current image when editing
    public $isEditing = false;

    // Mount: Initialize the list of dogs
    public function mount()
    {
        // No longer needed - we'll use the render method for data
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
            'image' => 'nullable|image|max:5024', // Max 5MB
        ]);

        // Create the dog first
        $dog = Dog::create([
            'name' => $this->name,
            'breed' => $this->breed,
            'age' => $this->age,
            'weight' => $this->weight,
            'color' => $this->color,
            'owner' => $this->owner,
            'additional_info' => $this->additional_info,
        ]);

        // Handle image upload if provided
        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->handleImageUpload($dog);

            // Update dog with image path
            $dog->update(['image_path' => $imagePath]);
        }

        // Reset the form
        $this->resetForm();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Dog successfully added!',
        ]);
        $this->dispatch('dog-added'); // Reset form and preview
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

        // Set current image path
        $this->currentImagePath = $dog->image_path;
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

        // Handle new image upload
        if ($this->image) {
            // Delete old image if exists
            if ($dog->image_path) {
                $this->deleteImage($dog->image_path);
            }

            // Upload new image
            $imagePath = $this->handleImageUpload($dog);
            $dog->update(['image_path' => $imagePath]);
        }

        // Reset the form
        $this->resetForm();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Dog successfully updated!',
        ]);
        $this->dispatch('dog-updated'); // Reset form and preview
    }

    // Delete a dog
    public function deleteDog(Dog $dog)
    {
        // Delete associated image if exists
        if ($dog->image_path) {
            $this->deleteImage($dog->image_path);
        }

        $dog->delete();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Dog successfully deleted!',
        ]);
    }

    // Remove current image
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

    // Generate safe filename for dog
    private function generateSafeFilename($dog, $extension)
    {
        // Create a safe filename using dog ID and sanitized name
        $safeName = Str::slug($dog->name, '-'); // Converts "Golden Retriever" to "golden-retriever"
        $timestamp = now()->format('YmdHis'); // Add timestamp for uniqueness

        return "dog-{$dog->id}-{$safeName}-{$timestamp}.{$extension}";
    }

    // Handle image upload
    private function handleImageUpload($dog)
    {
        if ($this->image) {
            // Ensure the storage/img directory exists
            if (!Storage::disk('public')->exists('img')) {
                Storage::disk('public')->makeDirectory('img');
            }

            // Get file extension
            $extension = $this->image->getClientOriginalExtension();

            // Generate safe filename
            $filename = $this->generateSafeFilename($dog, $extension);

            // Store the image
            $path = $this->image->storeAs('img', $filename, 'public');

            return $path;
        }
        return null;
    }

    // Delete image
    private function deleteImage($imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
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
        $this->image = null;
        $this->currentImagePath = null;
        $this->isEditing = false;
        $this->resetValidation();
    }

    #[Layout('layouts.project', ['title' => 'Dog Management', 'description' => 'Manage dogs in the kennel'])]
    public function render()
    {
        return view('livewire.crud.dog-crud', [
            'dogs' => Dog::paginate(10) // Paginate with 10 dogs per page
        ]);
    }
}
