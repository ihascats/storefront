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
        $this->startDate = now()->format('Y-m-d\TH:i');
        $this->endDate = now()->format('Y-m-d\TH:i');
        $this->calculateDuration();
        if ($currentVariant && $index) {
            $this->currentVariant = $currentVariant;
            $this->index = $index;
            $this->startDate = $currentVariant['start_date'];
            $this->endDate = $currentVariant['end_date'];
            $this->calculateDuration();
        }
    }
    public function calculateDuration() {
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
