<?php

namespace App\Livewire;

use Livewire\Component;

class ProductSpecifications extends Component
{   
    public $specs = [];
    public $newSpec = ['name' => '', 'description' => ''];
    public function render()
    {
        return view('livewire.product-specifications');
    }

    public function addSpec() {
        $this->specs[] = $this->newSpec;
        $this->dispatch('specificationsUpdated', $this->specs);
        $this->newSpec = ['name' => '', 'description' => '']; // Clear the input fields for the new spec
    }

    public function removeSpec($index) {
        $this->specs[$index]["deleted"] = true;
        $this->specs = array_values($this->specs); // Re-index the array after removing a spec
        $this->dispatch('specificationsUpdated', $this->specs);
    }
}
