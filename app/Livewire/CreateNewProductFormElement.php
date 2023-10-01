<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use DateTime;
use DateTimeZone;
use MongoDB\BSON\UTCDateTime;

class CreateNewProductFormElement extends Component
{
    public $description;
    public $formData = [
        'name' => '',
        'slug' => '',
        'description' => '',
        'specifications' => [],
        'wishlist_count' => 0,
        'categories' => [],
        'variants' => [],
    ];
    protected $listeners = [
        'nameUpdated' => 'updateName',
        'slugUpdated' => 'updateSlug',
        'specificationsUpdated' => 'updateSpecifications',
        'categoriesUpdated' => 'updateCategories',
        'variantsUpdated' => 'updateVariants',
    ];
    public function updateName($name)
    {
        $this->formData['name'] = $name;
    }
    public function updateSlug($slug)
    {
        $this->formData['slug'] = $slug;
    }
    public function updateSpecifications($specifications)
    {
        $this->formData['specifications'] = $specifications;
    }
    public function updateCategories($categories)
    {
        $this->formData['categories'] = $categories;
    }
    public function updateVariants($variants)
    {
        $this->formData['variants'] = $variants;
    }
    public function updateDescription()
    {
        $this->formData['description'] = $this->description;
    }
    public function render()
    {
        return view('livewire.create-new-product-form-element');
    }
    public function save()
    {
        $formDataClone = $this->formData;
        function setDateTime($dateLocalTime) {
            $formatLocalDateTime = new DateTime($dateLocalTime, new DateTimeZone(env('TIMEZONE')));

            // Convert the local DateTime to UTC DateTime
            $formatLocalDateTimeToUtc = $formatLocalDateTime->setTimezone(new DateTimeZone('UTC'));

            // Return a UTCDateTime object for MongoDB
            return new UTCDateTime($formatLocalDateTimeToUtc->getTimestamp() * 1000);
        }
        foreach ($formDataClone['variants'] as &$variant) {
            $variant['discount_start_date'] = setDateTime($variant['discount_start_date']);
            $variant['discount_exp_date'] = setDateTime($variant['discount_exp_date']);
        }
        Product::create($formDataClone);
        return $this->redirect('/');
    }
}