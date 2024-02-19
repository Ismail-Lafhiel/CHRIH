<?php

namespace App\Http\Livewire\Admin\Commande;

use App\Models\Commande;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $user_id;
    
    protected $rules = [
        'user_id' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Commande') ])]);
        
        Commande::create([
            'user_id' => $this->user_id,
            'user_id' => auth()->id(),
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.commande.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Commande') ])]);
    }
}
