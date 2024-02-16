<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $product;

    public $name;
    public $description;
    public $price;
    
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',        
    ];

    public function mount(Product $Product){
        $this->product = $Product;
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Product') ]) ]);
        
        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'user_id' => auth()->id(),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.product.update', [
            'product' => $this->product
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Product') ])]);
    }
}
