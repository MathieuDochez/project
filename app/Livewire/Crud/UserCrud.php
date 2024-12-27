<?php
namespace App\Livewire\Crud;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class UserCrud extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $userId;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
    ];


    public function toggleActive($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->active = !$user->active; // Toggle the active status
            $user->save(); // Save the updated status
            session()->flash('message', 'User status updated successfully');
        }
    }
    public function createUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->resetForm();
        $this->dispatch('swal:success', [
            'title' => 'User created',
            'text' => "The user '{$this->name}' has been successfully created.",
        ]);
    }

    public function editUser($id)
    {
        $this->isEditing = true;
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateUser()
    {
        $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'required|string|min:8',
        ];

        $this->validate($rules);

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        $this->resetForm();
        $this->dispatch('swal:success', [
            'title' => 'User updated',
            'text' => "The user '{$this->name}' has been successfully updated.",
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $this->emit('userUpdated');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->isActive = true;
        $this->userId = null;
        $this->isEditing = false;
    }


    #[Layout('layouts.project', ['title' => '', 'description' => 'Dog kennel Item'])]
    public function render()
    {
        $users = User::orderBy('id')->paginate(10);

        return view('livewire.crud.user-crud', [
            'users' => $users
        ]);
    }
}
