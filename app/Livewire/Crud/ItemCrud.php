<?php

namespace App\Livewire\Crud;

use App\Models\Item;
use App\Enums\ProductCategory;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemCrud extends Component
{
    use WithFileUploads, WithPagination;

    public $itemId, $name, $description, $price, $category, $stock;
    public $image;
    public $currentImagePath;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'price' => 'required|numeric|min:0.01',
        'category' => 'required|string',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|max:5024', // Max 5MB
    ];

    public function createItem()
    {
        $this->validate();

        $item = Item::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => ProductCategory::from($this->category),
            'stock' => $this->stock,
        ]);

        if ($this->image) {
            $imagePath = $this->handleImageUpload($item);
            $item->update(['image_path' => $imagePath]);
        }

        $this->resetForm();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Item successfully created!',
        ]);
        $this->dispatch('item-added');
    }

    public function editItem(Item $item)
    {
        $this->isEditing = true;
        $this->itemId = $item->id;
        $this->name = $item->name;
        $this->description = $item->description;
        $this->price = $item->price;
        $this->category = $item->category->value;
        $this->stock = $item->stock;
        $this->currentImagePath = $item->image_path;
    }

    public function updateItem()
    {
        $this->validate();

        $item = Item::find($this->itemId);

        $item->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => ProductCategory::from($this->category),
            'stock' => $this->stock,
        ]);

        if ($this->image) {
            if ($item->image_path) {
                $this->deleteImage($item->image_path);
            }

            $imagePath = $this->handleImageUpload($item);
            $item->update(['image_path' => $imagePath]);
        }

        $this->resetForm();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Item successfully updated!',
        ]);
        $this->dispatch('item-updated');
    }

    public function deleteItem(Item $item)
    {
        if ($item->image_path) {
            $this->deleteImage($item->image_path);
        }

        $item->delete();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Item successfully deleted!',
        ]);
    }

    public function removeCurrentImage()
    {
        if ($this->currentImagePath && $this->itemId) {
            $item = Item::find($this->itemId);

            if ($item && $item->image_path) {
                $this->deleteImage($item->image_path);
                $item->update(['image_path' => null]);
                $this->currentImagePath = null;

                $this->dispatch('swal:toast', [
                    'background' => 'success',
                    'html' => 'Image removed successfully!',
                ]);
            }
        }
    }

    private function generateSafeFilename($item, $extension)
    {
        $safeName = Str::slug($item->name, '-');
        $timestamp = now()->format('YmdHis');

        return "item-{$item->id}-{$safeName}-{$timestamp}.{$extension}";
    }

    private function handleImageUpload($item)
    {
        if ($this->image) {
            if (!Storage::disk('public')->exists('img')) {
                Storage::disk('public')->makeDirectory('img');
            }

            $extension = $this->image->getClientOriginalExtension();
            $filename = $this->generateSafeFilename($item, $extension);

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
        $this->itemId = null;
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
        $this->stock = '';
        $this->image = null;
        $this->currentImagePath = null;
        $this->isEditing = false;
        $this->resetValidation();
    }

    public function getCategoriesProperty()
    {
        return collect(ProductCategory::cases())->mapWithKeys(function ($case) {
            return [$case->value => ucfirst(str_replace('_', ' ', $case->value))];
        });
    }

    #[Layout('layouts.project', ['title' => 'Item Management', 'description' => 'Manage shop items'])]
    public function render()
    {
        return view('livewire.crud.item-crud', [
            'items' => Item::paginate(10)
        ]);
    }
}
