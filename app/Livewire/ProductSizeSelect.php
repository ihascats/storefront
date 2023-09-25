<?php

namespace App\Livewire;

use Livewire\Component;

class ProductSizeSelect extends Component
{
    public $showDropdown = false;
    public $newSizes = [];
    public $newSizeInput;
    public $selectedSize = null;
    public $currentVariant;
    public $index;
    public function render()
    {
        return view('livewire.product-size-select');
    }
    public function mount($currentVariant = null, $index = null)
    {
        if ($currentVariant) {
            $this->currentVariant = $currentVariant;
            $this->index = $index;
            $this->selectedSize = $currentVariant['size'];
        }
    }
    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }
    public function addSize() {
        if ($this->newSizeInput !== '') {
            // Trim any empty spaces at the start and end of $this->newSizeInput
            $trimmedInput = trim($this->newSizeInput);

            // Check if the trimmed input already exists in $this->newSizes
            if (!in_array($trimmedInput, $this->newSizes)) {
                // Add the trimmed input to the beginning of the array
                array_unshift($this->newSizes, $trimmedInput);

                // Update the selected size to the newly added size
                $this->selectedSize = $this->newSizes[0];
            } else {
                $this->selectedSize = $trimmedInput;
            }
            if (!$this->currentVariant) {
                $this->dispatch('sizeUpdated', $this->selectedSize);
            }
            // Reset the input field
            $this->newSizeInput = '';
        }
    }

    public function selectSize($size) {
        $this->selectedSize = $size;
        if (!$this->currentVariant) {
            $this->dispatch('sizeUpdated', $size);
        }
    }
}
