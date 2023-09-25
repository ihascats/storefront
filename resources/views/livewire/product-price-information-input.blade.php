<label class="flex flex-col tracking-wider">Price
    <div class="flex">
        <input wire:input="calculateDiscountedPrice" @if($currentVariant)name="variants[{{$index}}][price]" @endif wire:model="price" id="price" type="number" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-9 w-36" step="0.01">
        <select wire:change="setCurrency" @if($currentVariant)name="variants[{{$index}}][currency]" @endif wire:model="currency" id="currency-select" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-9 text-xs">
            <option class="bg-slate-600" value="RSD">RSD (Serbian Dinar)</option>
            <option class="bg-slate-600" value="EUR">EUR (Euro)</option>
            <option class="bg-slate-600" value="USD">USD (US Dollar)</option>
        </select>
    </div>
    <ul class="flex gap-2 pl-2">
        <label class="flex flex-col tracking-wider text-sm">amount
            <div class="flex gap-2">
                <input @if($currentVariant)name="variants[{{$index}}][discount]" @endif wire:input="calculateDiscountedPrice" wire:model="discountAmount" id="discount" type="number" min="0" max="100" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7 w-20"><span class="text-3xl">%</span><span class="text-lg mt-1">-></span><span class="text-lg mt-1" id="discountedPrice">Discounted Price: {{ $discountedPrice }} {{ $currency }}</span>
            </div>
        </label>
    </ul>
</label>