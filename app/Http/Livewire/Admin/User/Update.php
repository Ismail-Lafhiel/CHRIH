<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $user;

    public $name;
    public $email;
    public $password;
    
    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',        
    ];

    public function mount(User $User){
        $this->user = $User;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->password = $this->user->password;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('User') ]) ]);
        
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'user_id' => auth()->id(),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.user.update', [
            'user' => $this->user
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('User') ])]);
    }
}
