<?php

namespace App\Http\Livewire\Admin\Commande;

use App\Models\Commande;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $commande;

    public $user_id;
    
    protected $rules = [
        'user_id' => 'required',        
    ];

    public function mount(Commande $Commande){
        $this->commande = $Commande;
        $this->user_id = $this->commande->user_id;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Commande') ]) ]);
        
        $this->commande->update([
            'user_id' => $this->user_id,
            'user_id' => auth()->id(),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.commande.update', [
            'commande' => $this->commande
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Commande') ])]);
    }
}
