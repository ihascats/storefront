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
    public function slugUpdated() {
        $this->dispatch('slugUpdated', $this->slug);
    }

    public function setSlug() {
        $this->slug = strtolower(str_replace(' ', '-', $this->name));
        $this->dispatch('nameUpdated', $this->name);
        $this->dispatch('slugUpdated', $this->slug);
    }
}
