<?php

namespace App\Livewire;

use Livewire\Component;

class ProductQuantityInput extends Component
{
    public $quantity = 1;
    public $currentVariant;
    public $index;
    public function render()
    {
        return view('livewire.product-quantity-input');
    }
    public function mount($currentVariant = null, $index = null)
    {
        if ($currentVariant) {
            $this->currentVariant = $currentVariant;
            $this->index = $index;
            $this->quantity = $currentVariant['quantity'];
        }
    }
    
    public function quantityChanged() {
        if (!$this->currentVariant) {
            $this->dispatch('quantityUpdated', $this->quantity);
        }
    }
}
