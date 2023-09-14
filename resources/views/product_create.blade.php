<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Create New Product') }}
    </h2>
  </x-slot>
  <div class="text-white p-4 max-w-7xl mx-auto">
    <form  method="POST" action="{{ route('products.store') }}" class="flex flex-col gap-3">
      @csrf
      <label class="flex flex-col tracking-wider">Name  
        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="name">
      </label>
      <label class="flex flex-col tracking-wider">Slug  
        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="slug">
      </label>
      <label class="flex flex-col tracking-wider">Price  
        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="price">
      </label>
      <label class="flex flex-col tracking-wider">Currency  
        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="currency">
      </label>
      <label class="flex flex-col tracking-wider">Description  
        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="description">
      </label>
      <label class="tracking-wider">Specifications
        <ul class="pl-2" id="specList">
          <li class="flex items-end">
            <label class="flex flex-col tracking-wider w-full">name  
              <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="spec_name" id="spec_name">
            </label>
            <label class="flex flex-col tracking-wider w-full">description
              <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="spec_desc" id="spec_desc">
            </label>
            <button id="addSpec" type="button" class="bg-orange-600 rounded-md px-4 h-7">add</button>
          </li>
        </ul>
      </label>
      <label class="flex flex-col tracking-wider">Discount
        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="discount">
      </label>
      <label class="flex flex-col tracking-wider">Discount exp date
        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="discount_exp_date">
      </label>
      <label class="tracking-wider">Variants
        <ul class="flex flex-col tracking-wider pl-2" id="variantList">
            <li class="flex items-start gap-2">
                <div class="relative w-full mt-[10px]">
                    <button
                        type="button"
                        class="py-2 px-4 bg-slate-800 text-gray-300 rounded-md border border-slate-600 hover:bg-slate-600 focus:outline-none focus:bg-slate-800 w-full"
                        id="colorsDropdownButton"
                    >
                        Select Colors
                    </button>
                    <ul
                    id="colorsDropdown"
                    class="bg-slate-800 border border-slate-600 py-1 w-full rounded-md shadow-lg hidden"
                    >
                      <label for="new_color" class="relative flex gap-2 items-center">
                          <input
                              type="text"
                              id="new_color"
                              placeholder="New Color"
                              class="inline float-left bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7"
                          >
                          <button id="addColor" type="button" class="bg-orange-600 rounded-md px-4 h-7">add</button>
                      </label>
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
                                        >
                                        {{ $color }}
                                    </label>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="relative w-full mt-[10px]">
                    <button
                        type="button"
                        class="py-2 px-4 bg-slate-800 text-gray-300 rounded-md border border-slate-600 hover:bg-slate-600 focus:outline-none focus:bg-slate-800 w-full"
                        id="sizesDropdownButton"
                    >
                        Select Sizes
                    </button>

                    <ul
                        id="sizesDropdown"
                        class="bg-slate-800 border border-slate-600 py-1 w-full rounded-md shadow-lg hidden"
                    >
                      <label for="size" class="relative flex gap-2 items-center">
                          <input
                              type="text"
                              id="new_size"
                              placeholder="New Size"
                              class="inline float-left bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7"
                          >
                          <button id="addSize" type="button" class="bg-orange-600 rounded-md px-4 h-7">add</button>
                      </label>
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
                <label class="flex flex-col tracking-wider w-full text-sm mt-1">quantity
                    <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7" id="variant_quantity">
                </label>
                <button id="addVariant" type="button" class="bg-orange-600 rounded-md px-4 h-7 mt-6">add</button>
            </li>
        </ul>
        <script>
            // JavaScript to toggle the dropdown menus
          document.addEventListener("DOMContentLoaded", function () {

            const sizesDropdownButton = document.getElementById("sizesDropdownButton");
            const sizesDropdown = document.getElementById("sizesDropdown");

            const colorsDropdownButton = document.getElementById("colorsDropdownButton");
            const colorsDropdown = document.getElementById("colorsDropdown");

            sizesDropdownButton.addEventListener("click", function () {
                sizesDropdown.classList.toggle("hidden");
            });

            colorsDropdownButton.addEventListener("click", function () {
                colorsDropdown.classList.toggle("hidden");
            });

            // Close the dropdowns when clicking outside of them
            document.addEventListener("click", function (event) {
                if (!sizesDropdownButton.contains(event.target) && !sizesDropdown.contains(event.target)) {
                    sizesDropdown.classList.add("hidden");
                }

                if (!colorsDropdownButton.contains(event.target) && !colorsDropdown.contains(event.target)) {
                    colorsDropdown.classList.add("hidden");
                }
            });
          });
        </script>
      </label>
      <label for="categories" class="tracking-wider">Categories
        <ul id="categoriesList" class="flex flex-col">
          <label for="new_category" class="p-2">
            <input name="new_category" id="new_category" type="text" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7">
            <button id="addCategory" type="button" class="bg-orange-600 rounded-md px-4">
              add
            </button>
          </label>
        @if($categories)
          @foreach ( $categories as $category)
          <label class="pl-2 relative flex gap-2 items-center w-fit">
            <input type='checkbox' name='categories[]' value='{{$category}}' class="inline float-left">
            <span>{{ $category }}</span>
          </label>
          @endforeach
        @endif
        </ul>
      </label>
      <button class="bg-green-600 rounded-md py-2 text-3xl tracking-wider">Submit</button>
    </form>
  </div>
  <div class="bg-red-600"><div>
</x-app-layout>