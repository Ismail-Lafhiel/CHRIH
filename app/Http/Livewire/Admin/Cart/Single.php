<?php

namespace App\Http\Livewire\Admin\Cart;

use App\Models\Cart;
use Livewire\Component;

class Single extends Component
{

    public $cart;

    public function mount(Cart $Cart){
        $this->cart = $Cart;
    }

    public function delete()
    {
        $this->cart->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Cart') ]) ]);
        $this->emit('cartDeleted');
    }

    public function render()
    {
        return view('livewire.admin.cart.single')
            ->layout('admin::layouts.app');
    }
}
