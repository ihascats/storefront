<?php

namespace App\Livewire;

use Livewire\Component;

class ProductCategoriesSelect extends Component
{
    public $showDropdown = false;
    public $newCategories = [];
    public $newCategoryInput;
    public $selectedCategories = [];
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
            array_unshift($this->selectedCategories, $this->newCategoryInput);
            $this->newCategoryInput = '';
        }
    }
    public function updateSelectedCategories()
    {
        $this->selectedCategories = array_unique($this->selectedCategories);

        // Dispatch the event with the updated selected categories
        $this->dispatch('categoriesUpdated', $this->selectedCategories);
    }

}
