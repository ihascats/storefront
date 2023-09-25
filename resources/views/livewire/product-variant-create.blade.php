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
        @foreach($variantsList as $index=>$variant)
            @if(!isset($variant["deleted"]))
                <li class="bg-white/10 p-2 rounded-lg">
                    @livewire('variant-list-item', ['currentVariant' => $variant, 'index' => $index], key($index))
                    <button wire:click="removeVariant({{$index}})" id="removeVariant" type="button" class="bg-red-600 rounded-md px-4 h-7 mt-6 w-full">del</button>
                </li>
            @endif
        @endforeach
    </ul>
</div>
