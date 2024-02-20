<?php

namespace App\Http\Livewire\Admin\Cart;

use App\Models\Cart;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $cart;

    
    protected $rules = [
        
    ];

    public function mount(Cart $Cart){
        $this->cart = $Cart;
        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Cart') ]) ]);
        
        $this->cart->update([
            'user_id' => auth()->id(),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.cart.update', [
            'cart' => $this->cart
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Cart') ])]);
    }
}
