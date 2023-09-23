<?php

namespace App\Livewire;

use Livewire\Component;

class ProductPriceInformationInput extends Component
{
    public $price = 0;
    public $currency = "RSD";
    public $discountAmount = 0;
    public $discountedPrice = 0;

    public function render() {
        return view('livewire.product-price-information-input');
    }
    public function calculateDiscountedPrice() {
        $this->dispatch('priceUpdated', $this->price);
        $this->dispatch('discountUpdated', $this->discountAmount);
        $this->discountedPrice = number_format($this->price - ($this->price * ($this->discountAmount / 100)), 2);
    }
    public function setCurrency() {
        $this->dispatch('currencyUpdated', $this->currency);
        $this->currency;
    }

}
