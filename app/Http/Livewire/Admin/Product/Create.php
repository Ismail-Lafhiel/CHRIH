<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $price;
    
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Product') ])]);
        
        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'user_id' => auth()->id(),
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.product.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Product') ])]);
    }
}
