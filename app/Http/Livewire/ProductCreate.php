<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductCreate extends Component
{
    public $product = [
        'name' => '',
        'description' => '',
    ];

    protected $rules = [
        'product.name' => 'required|min:5',
        'product.description' => 'required|min:30',
    ];

    public $designTemplate = 'tailwind';

    public function render()
    {
        return view('livewire.'.$this->designTemplate.'.product-create');
    }

    public function submitForm()
    {
        $this->validate();
        Product::create($this->product);

        $this->reset('product');
        $this->emit('reinit');

        session()->flash('message', 'Product successfully created!');
    }
}
