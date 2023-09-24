<?php

namespace App\Livewire;

use Livewire\Component;

class ProductColorSelect extends Component
{
    public $showDropdown = false;
    public $newColors = [];
    public $newColorInput;
    public $selectedColor = null;
    public $currentVariant;
    public function render()
    {
        return view('livewire.product-color-select');
    }
    public function mount($currentVariant = null)
    {
        if ($currentVariant) {
            $this->currentVariant = $currentVariant;
            $this->selectedColor = $currentVariant['color'];
        }
    }
    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }
    public function addColor() {
        if ($this->newColorInput !== '') {
            // Trim any empty spaces at the start and end of $this->newColorInput
            $trimmedInput = trim($this->newColorInput);

            // Check if the trimmed input already exists in $this->newColors
            if (!in_array($trimmedInput, $this->newColors)) {
                // Add the trimmed input to the beginning of the array
                array_unshift($this->newColors, $trimmedInput);

                // Update the selected color to the newly added color
                $this->selectedColor = $this->newColors[0];
            } else {
                $this->selectedColor = $trimmedInput;
            }
            if (!$this->currentVariant) {
                $this->dispatch('colorUpdated', $this->selectedColor);
            }
            // Reset the input field
            $this->newColorInput = '';
        }
    }
    public function selectColor($color)
    {
        $this->selectedColor = $color;
        if (!$this->currentVariant) {
            $this->dispatch('colorUpdated', $color);
        }
    }

}
