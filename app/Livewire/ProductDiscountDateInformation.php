<?php

namespace App\Livewire;

use Livewire\Component;

class ProductDiscountDateInformation extends Component
{
    public $startDate;
    public $endDate;
    public $discountDuration = 'set start and end dates';
    public $currentVariant;
    public $index;
    public function render()
    {
        return view('livewire.product-discount-date-information');
    }
    public function mount($currentVariant = null, $index = null)
    {
        date_default_timezone_set(env('TIMEZONE'));

        $this->startDate = now()->format('Y-m-d\TH:i');
        $this->endDate = now()->format('Y-m-d\TH:i');
        if ($currentVariant && $index !== null) {
            $this->currentVariant = $currentVariant;
            $this->index = $index;
            $this->startDate = $currentVariant['discount_start_date'];
            $this->endDate = $currentVariant['discount_exp_date'];
        }
        $this->calculateDuration();
    }
    public function calculateDuration() {
        // Disables dispatch if the element is created as a part of the form submit list
        if (!$this->currentVariant) {
            $this->dispatch('startDateUpdated', $this->startDate);
            $this->dispatch('endDateUpdated', $this->endDate);
        }
        if ($this->startDate && $this->endDate) {
            $startDate = new \DateTime($this->startDate);
            $endDate = new \DateTime($this->endDate);
            
            if ($startDate <= $endDate) {
                $interval = $startDate->diff($endDate);
                $this->discountDuration = $interval->format('%ad, %hh, %im, %ss');

                return;
            }
        }
        if (!$this->startDate){
            $this->discountDuration = 'set start date';
        }
        if (!$this->endDate){
            $this->discountDuration = 'set end date';
        }
    }
}
