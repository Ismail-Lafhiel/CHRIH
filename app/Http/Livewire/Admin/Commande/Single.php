<?php

namespace App\Http\Livewire\Admin\Commande;

use App\Models\Commande;
use Livewire\Component;

class Single extends Component
{

    public $commande;

    public function mount(Commande $Commande){
        $this->commande = $Commande;
    }

    public function delete()
    {
        $this->commande->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Commande') ]) ]);
        $this->emit('commandeDeleted');
    }

    public function render()
    {
        return view('livewire.admin.commande.single')
            ->layout('admin::layouts.app');
    }
}
