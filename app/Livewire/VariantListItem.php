<?php

namespace App\Livewire;

use Livewire\Component;

class VariantListItem extends Component
{
    public $currentVariant;
    public function render()
    {
        return view('livewire.variant-list-item');
    }
    public function mount($currentVariant = null)
    {
        if ($currentVariant) {
            $this->currentVariant = $currentVariant;
        }
    }
}
