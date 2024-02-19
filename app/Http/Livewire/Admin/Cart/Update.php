<?php

namespace App\Http\Livewire\Admin\Cart;

use App\Models\Cart;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $cart;

    public $product_id;
    
    protected $rules = [
        'product_id' => 'required',        
    ];

    public function mount(Cart $Cart){
        $this->cart = $Cart;
        $this->product_id = $this->cart->product_id;        
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
            'product_id' => $this->product_id,
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
