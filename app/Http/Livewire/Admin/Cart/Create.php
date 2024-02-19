<?php

namespace App\Http\Livewire\Admin\Cart;

use App\Models\Cart;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $product_id;
    
    protected $rules = [
        'product_id' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Cart') ])]);
        
        Cart::create([
            'product_id' => $this->product_id,
            'user_id' => auth()->id(),
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.cart.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Cart') ])]);
    }
}
