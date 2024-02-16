<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;

class Single extends Component
{

    public $product;

    public function mount(Product $Product){
        $this->product = $Product;
    }

    public function delete()
    {
        $this->product->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Product') ]) ]);
        $this->emit('productDeleted');
    }

    public function render()
    {
        return view('livewire.admin.product.single')
            ->layout('admin::layouts.app');
    }
}
