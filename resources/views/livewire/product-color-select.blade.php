<div class="relative w-full mt-[10px]">
    <button
        type="button"
        wire:click="toggleDropdown"
        class="py-2 px-4 bg-slate-800 text-gray-300 rounded-md border border-slate-600 hover:bg-slate-600 focus:outline-none focus:bg-slate-800 w-full"
        id="colorsDropdownButton"
    >
        Select Colors
    </button>
    <ul
    id="colorsDropdown"
    class="bg-slate-800 border border-slate-600 py-1 w-full rounded-md shadow-lg {{ $showDropdown ? '' : 'hidden' }}"
    >
    <label for="new_color" class="relative flex gap-2 items-center">
        <input
            wire:model="newColorInput"
            type="text"
            id="new_color"
            placeholder="New Color"
            class="inline float-left bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7"
        >
        <button wire:click="addColor" type="button" class="bg-orange-600 rounded-md px-4 h-7">add</button>
    </label>
        @foreach($newColors as $newColor)
            <li>
                <label for="color_{{$newColor}}" class="pl-2 relative flex gap-2 items-center">
                    <input
                        type="radio"
                        id="color_{{$newColor}}"
                        name="colors[]"
                        value="{{ $newColor }}"
                        class="inline float-left"
                        wire:click="selectColor('{{ $newColor }}')"
                        @if ($selectedColor === $newColor)
                            checked
                        @endif
                    >
                    {{ $newColor }}
                </label>
            </li>
        @endforeach
        @if($colors)
            @foreach($colors as $color)
                <li>
                    <label for="color_{{$color}}" class="pl-2 relative flex gap-2 items-center">
                        <input
                            type="radio"
                            id="color_{{$color}}"
                            name="colors[]"
                            value="{{ $color }}"
                            class="inline float-left"
                            wire:click="selectColor('{{ $color }}')"
                            @if ($selectedColor === $color)
                                checked
                            @endif
                            >
                        {{ $color }}
                    </label>
                </li>
            @endforeach
        @endif
    </ul>
</div>