<div>
    <label class="tracking-wider -mb-4">Variants</label>
    <ul class="flex flex-col tracking-wider pl-2" id="variantList">
         <li class="flex flex-col items-start gap-2">
            <div class="flex flex-col tracking-wider pl-2">
                @livewire('product-price-information-input')
                @livewire('product-discount-date-information')
            </div>
            <div class="flex items-start gap-2 w-full">
                @livewire('product-color-select')
                @livewire('product-size-select')
                @livewire('product-quantity-input')

                <button wire:click="addVariant" id="addVariant" type="button" class="bg-orange-600 rounded-md px-4 h-7 mt-6">add</button>
            </div>
        </li>
        @foreach($variantsList as $variant)
            @foreach($variant as $items)
                <div>
                    {{$items}}
                </div>  
            @endforeach
        @endforeach
        <--- new elements below this line --->
        <li class="flex flex-col items-start gap-2 bg-white/10 p-2 rounded-lg">
            <div class="flex flex-col tracking-wider pl-2">
                @livewire('product-price-information-input')
                @livewire('product-discount-date-information')
            </div>
            <div class="flex items-start gap-2 w-full">
                @livewire('product-color-select')
                @livewire('product-size-select')
                <label class="flex flex-col tracking-wider w-full text-sm mt-1">quantity
                    <input type="number" min="1" value="1" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7" id="variant_quantity">
                </label>
                <button id="addVariant" type="button" class="bg-orange-600 rounded-md px-4 h-7 mt-6">add</button>
            </div>
            <button id="addVariant" type="button" class="bg-red-600 rounded-md px-4 h-7 mt-6 w-full">del</button>
        </li>
    </ul>
</div>
