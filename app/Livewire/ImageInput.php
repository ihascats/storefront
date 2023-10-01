<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImageInput extends Component
{
    use WithFileUploads;
    public $showDropdown = false;
    public $images = [];
    public $index;
    public function mount($currentVariant = null, $index = null)
    {
        if ($currentVariant) {
            $this->index = $index;
        }
    }
    protected $rules = [
        'images' => 'max:5', // Adjust the maximum number of images allowed
    ];

    protected $messages = [
        'images.max' => 'Image limit exceeded (5).', // Customize the error message
    ];

    public function updatedImages()
    {
        $this->validateOnly('images');

        $names = [];
        foreach($this->images as $image){
            $names[] = $image->getClientOriginalName();
        }
        $this->dispatch('imagesUpdated', $names, $this->index);
    }

    public function render()
    {
        return view('livewire.image-input');
    }

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }
}