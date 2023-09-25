<div class="dropdown pl-2">
    <button wire:click="toggleDropdown" type="button" class="py-2 px-4 bg-slate-800 text-gray-300 rounded-md border border-slate-600 hover:bg-slate-600 focus:outline-none focus:bg-slate-800 w-full">
        Select Images
    </button>
    <ul class="bg-slate-800 border border-slate-600 py-1 w-full rounded-md shadow-lg {{ $showDropdown ? '' : 'hidden' }}">
        @error('images')
            <li class="text-red-500 pl-2">{{ $message }}</li>
        @enderror

        <label for="new_image" class="relative flex gap-2 items-center">
            <input wire:model="images" name="variants[{{$index}}][images][]" type="file" accept="image/*" class="inline float-left bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" multiple>
        </label>
        <ul id="images_list" class="flex flex-wrap gap-3">
            @foreach ($images as $image)
                <li class="h-36 w-36 overflow-hidden">
                    <img src="{{ $image->temporaryUrl() }}" class="preview-image" alt="Image Preview">
                </li>
            @endforeach
        </ul>
    </ul>
</div>