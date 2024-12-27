<?php
namespace App\Livewire\Crud;

use App\Models\Item;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ItemCrud extends Component
{
    use WithPagination;

    public $name = '';
    public $description = '';
    public $price = '';
    public $isEditing = false;
    public $editItemId = null;

    // Validation rules for the form
    public $rules = [
        'name' => 'required|min:3|max:100',
        'description' => 'required|max:255',
        'price' => 'required|numeric|min:0',
    ];

    // Fetch paginated items
    public function fetchItems()
    {
        return Item::orderBy('id')->paginate(5); // Paginate results
    }

    // Create item
    public function createItem()
    {
        $this->validate($this->rules);

        Item::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ]);

        $this->resetForm();
        $this->resetPage(); // Reset pagination
    }

    // Edit item
    public function editItem(Item $item)
    {
        $this->name = $item->name;
        $this->description = $item->description;
        $this->price = $item->price;
        $this->isEditing = true;
        $this->editItemId = $item->id;
    }

    // Update item
    public function updateItem()
    {
        $this->validate($this->rules);

        $item = Item::find($this->editItemId);

        $item->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ]);

        $this->resetForm();
        $this->resetPage(); // Reset pagination
    }

    // Delete item
    public function deleteItem(Item $item)
    {
        $item->delete();
        $this->resetPage(); // Reset pagination
    }

    // Reset form fields
    private function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->isEditing = false;
        $this->editItemId = null;
    }

    #[Layout('layouts.project', ['title' => '', 'description' => 'Dog kennel Item'])]
    // Render the component with paginated items
    public function render()
    {
        $items = $this->fetchItems();

        return view('livewire.crud.item-crud', [
            'items' => $items,
        ]);
    }
}


