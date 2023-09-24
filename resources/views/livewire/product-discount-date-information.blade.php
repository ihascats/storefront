<label class="tracking-wider">Discount
    <ul class="flex gap-2 pl-2">
        <label class="flex flex-col tracking-wider text-sm">start date
            <input wire:change="calculateDuration" @if($currentVariant)name="variants[][discount_start_date]" @endif wire:model="startDate" id="start_date" type="datetime-local" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7">
        </label>
        <label class="flex flex-col tracking-wider text-sm">end date
            <input wire:change="calculateDuration" @if($currentVariant)name="variants[][discount_exp_date]" @endif wire:model="endDate" id="end_date" type="datetime-local" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7">
        </label>
        <span class="text-lg mt-5" id="discountDuration">Discount Duration: {{ $discountDuration }}</span>
    </ul>
</label>