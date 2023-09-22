<div class="relative w-full mt-[10px]">
    <button
        type="button"
        wire:click="toggleDropdown"
        class="py-2 px-4 bg-slate-800 text-gray-300 rounded-md border border-slate-600 hover:bg-slate-600 focus:outline-none focus:bg-slate-800 w-full"
        id="sizesDropdownButton"
    >
        Select Sizes
    </button>

    <ul
        id="sizesDropdown"
        class="bg-slate-800 border border-slate-600 py-1 w-full rounded-md shadow-lg {{ $showDropdown ? '' : 'hidden' }}"
    >
    <label for="size" class="relative flex gap-2 items-center">
        <input
            wire:model="newSizeInput"
            type="text"
            id="new_size"
            placeholder="New Size"
            class="inline float-left bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7"
        >
        <button wire:click="addSize" type="button" class="bg-orange-600 rounded-md px-4 h-7">add</button>
    </label>
        @foreach($newSizes as $index => $newSize)
            <li>
                <label for="size_{{$newSize}}" class="pl-2 relative flex gap-2 items-center">
                    <input
                        type="radio"
                        id="size_{{$newSize}}"
                        name="sizes[]"
                        value="{{ $newSize }}"
                        class="inline float-left"
                        @if ($selectedSize === $newSize)
                            checked
                        @endif
                    >
                    {{ $newSize }}
                </label>
            </li>
        @endforeach
        @if($sizes)
            @foreach($sizes as $size)
                <li>
                    <label for="size_{{$size}}" class="pl-2 relative flex gap-2 items-center">
                        <input
                            type="radio"
                            id="size_{{$size}}"
                            name="sizes[]"
                            value="{{ $size }}"
                            class="inline float-left"
                        >
                        {{ $size }}
                    </label>
                </li>
            @endforeach
        @endif
    </ul>
</div>