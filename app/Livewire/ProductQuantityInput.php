<?php

namespace App\Livewire;

use Livewire\Component;

class ProductQuantityInput extends Component
{
    public $quantity = 1;
    public function render()
    {
        return view('livewire.product-quantity-input');
    }
    
    public function quantityChanged() {
        $this->dispatch('quantityUpdated', $this->quantity);
    }
}
