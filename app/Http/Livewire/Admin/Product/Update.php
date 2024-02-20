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
    public $product_image;
    
    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',        
    ];

    public function mount(Product $Product){
        $this->product = $Product;
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->product_image = $this->product->product_image;        
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
        
        if($this->getPropertyValue('product_image') and is_object($this->product_image)) {
            $this->product_image = $this->getPropertyValue('product_image')->store('product_image');
        }

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'product_image' => $this->product_image,
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
