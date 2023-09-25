<?php

namespace App\Livewire;

use Livewire\Component;

class ProductPriceInformationInput extends Component
{
    public $price = 0;
    public $currency = "RSD";
    public $discountAmount = 0;
    public $discountedPrice = 0;
    public $currentVariant;
    public $index;
    public function render() {
        return view('livewire.product-price-information-input');
    }
    public function mount($currentVariant = null, $index = null)
    {
        if ($currentVariant) {
            $this->currentVariant = $currentVariant;
            $this->index = $index;
            $this->price = $currentVariant['price'];
            $this->currency = $currentVariant['currency'];
            $this->discountAmount = $currentVariant['discount'];
            $this->calculateDiscountedPrice();
        }
    }
    public function calculateDiscountedPrice() {
        if (!$this->currentVariant) {
            $this->dispatch('priceUpdated', $this->price);
            $this->dispatch('discountUpdated', $this->discountAmount);
        }
        $this->discountedPrice = number_format($this->price - ($this->price * ($this->discountAmount / 100)), 2);
    }
    public function setCurrency() {
        if (!$this->currentVariant) {
            $this->dispatch('currencyUpdated', $this->currency);
        }
        $this->currency;
    }

}
