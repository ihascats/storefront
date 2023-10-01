<div class="flex flex-col items-start gap-2">
    <div class="flex flex-col tracking-wider pl-2 w-full">
        @livewire('image-input', ['index' => $index])
        @livewire('product-price-information-input', ['currentVariant' => $currentVariant, 'index' => $index])
        @livewire('product-discount-date-information', ['currentVariant' => $currentVariant, 'index' => $index])
    </div>
    <div class="flex items-start gap-2 w-full">
        <label class="flex flex-col tracking-wider w-full">color
            <input value="{{$currentVariant["color"]}}" name="variants[{{$index}}][color]" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7"> 
        </label>
        <label class="flex flex-col tracking-wider w-full">size
            <input value="{{$currentVariant["sizes"]}}" name="variants[{{$index}}][sizes]" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7"> 
        </label>
        @livewire('product-quantity-input', ['currentVariant' => $currentVariant, 'index' => $index])
    </div>
</div>