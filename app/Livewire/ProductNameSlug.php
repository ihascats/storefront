<?php

namespace App\Livewire;

use Livewire\Component;

class ProductNameSlug extends Component
{
    public $name;
    public $slug;
    public function render() {
        return view('livewire.product-name-slug');
    }

    public function setSlug() {
        $this->slug = strtolower(str_replace(' ', '-', $this->name));
    }
}
