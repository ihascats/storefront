<?php

namespace App\Livewire;

use Livewire\Component;

class ProductVariantCreate extends Component
{
    public $variantsList = [];
    public $currentVariant = [
        'price' => 0, // Set the default price here
        'discount' => 0, // Set the default discount here
        'currency' => "RSD", // Set the default currency here
        'quantity' => 1, // Set the default quantity here
    ];

    protected $listeners = [
        'priceUpdated' => 'updatePrice',
        'discountUpdated' => 'updateDiscount',
        'currencyUpdated' => 'updateCurrency',
        'startDateUpdated' => 'updateStartDate',
        'endDateUpdated' => 'updateEndDate',
        'colorUpdated' => 'updateColor',
        'sizeUpdated' => 'updateSize',
        'quantityUpdated' => 'updateQuantity',
    ];

    public function render()
    {
        return view('livewire.product-variant-create');
    }

    public function updatePrice($price)
    {
        $this->currentVariant['price'] = $price;
    }

    public function updateDiscount($discount)
    {
        $this->currentVariant['discount'] = $discount;
    }

    public function updateCurrency($currency)
    {
        $this->currentVariant['currency'] = $currency;
    }

    public function updateStartDate($startDate)
    {
        $this->currentVariant['start_date'] = $startDate;
    }

    public function updateEndDate($endDate)
    {
        $this->currentVariant['end_date'] = $endDate;
    }

    public function updateColor($color)
    {
        $this->currentVariant['color'] = $color;
    }

    public function updateSize($size)
    {
        $this->currentVariant['size'] = $size;
    }

    public function updateQuantity($quantity)
    {
        $this->currentVariant['quantity'] = $quantity;
    }

    // Add a method to handle adding the current variant to the list of variants
    public function addVariant()
    {   

        // Ensure the current variant has all required data before adding it to the list
        if (
            isset($this->currentVariant['price']) &&
            isset($this->currentVariant['discount']) &&
            isset($this->currentVariant['currency']) &&
            isset($this->currentVariant['start_date']) &&
            isset($this->currentVariant['end_date']) &&
            isset($this->currentVariant['color']) &&
            isset($this->currentVariant['size']) &&
            isset($this->currentVariant['quantity'])
        ) {
            // Add the current variant to the list of variants
            $this->variantsList[] = $this->currentVariant;

        }
    }
}
