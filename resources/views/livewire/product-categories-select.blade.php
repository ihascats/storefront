<div>
    <label for="categories" class="tracking-wider -mb-2">Categories</label>
    <div class="dropdown pl-2">
        <button wire:click="toggleDropdown" id="categoriesDropdownButton" type="button" class="py-2 px-4 bg-slate-800 text-gray-300 rounded-md border border-slate-600 hover:bg-slate-600 focus:outline-none focus:bg-slate-800 w-full">
            Select Categories
        </button>
        <ul id="categoriesDropdown" class="bg-slate-800 border border-slate-600 py-1 w-full rounded-md shadow-lg {{ $showDropdown ? '' : 'hidden' }}">
            <label for="new_category" class="relative flex gap-2 items-center">
                <input wire:model="newCategoryInput" type="text" id="new_category" placeholder="New Category" class="inline float-left bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7">
                <button wire:click="addCategory" type="button" class="bg-orange-600 rounded-md px-4 h-7">Add</button>
            </label>
            @foreach($newCategories as $newCategory)
                <li>
                    <label for="category_{{$newCategory}}" class="pl-2 relative flex gap-2 items-center">
                        <input
                            wire:model="selectedCategories"
                            wire:click="updateSelectedCategories"
                            type="checkbox"
                            id="category_{{$newCategory}}"
                            name="categories[]"
                            value="{{$newCategory}}"
                            class="inline float-left"
                            {{ in_array($newCategory, $selectedCategories) ? 'checked' : '' }}
                        >
                        {{$newCategory}}
                    </label>
                </li>
            @endforeach

            @if($categories)
                @foreach($categories as $category)
                    <li>
                        <label for="category_{{$category}}" class="pl-2 relative flex gap-2 items-center">
                            <input
                                wire:model="selectedCategories"
                                wire:click="updateSelectedCategories"
                                type="checkbox"
                                id="category_{{$category}}"
                                name="categories[]"
                                value="{{$category}}"
                                class="inline float-left"
                                {{ in_array($category, $selectedCategories) ? 'checked' : '' }}
                            >
                            {{$category}}
                        </label>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
