<?php

namespace App\Livewire;

use Livewire\Component;

class ProductCategoriesSelect extends Component
{
    public $showDropdown = false;
    public $newCategories = [];
    public $newCategoryInput;
    public function render()
    {
        return view('livewire.product-categories-select');
    }
    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function addCategory() {
        if($this->newCategoryInput !== '') {
            array_unshift($this->newCategories, $this->newCategoryInput);
            $this->newCategoryInput = '';
        }
    }
}
