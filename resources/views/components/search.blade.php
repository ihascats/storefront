<form action="/search" method="GET" class="flex flex-col gap-2 text-white p-2">
    @csrf
    <label for="query" class="mb-4">
        <input type="text" name="query" placeholder="Search..." value="{{ isset($request['query']) ? $request['query'] : '' }}" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-10 w-full">
        <button type="submit" class="py-2 px-4 bg-green-800 text-gray-300 rounded-md border border-green-600 hover:bg-green-600 focus:outline-none focus:bg-green-800 w-full">Search</button>
    </label>
    <label for="min-price" class="flex flex-col">Min Price:
        <input type="number" name="min-price" id="min-price" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{ isset($request['min-price']) ? $request['min-price'] : $minPrice }}" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7">
        <input type="range" id="min-priceSlider" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{ isset($request['min-price']) ? $request['min-price'] : $minPrice }}" class="ml-2 h-7">
    </label>
    <label for="max-price" class="flex flex-col">Max Price:
        <input type="number" name="max-price" id="max-price" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{ isset($request['max-price']) ? $request['max-price'] : $maxPrice }}" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7">
        <input type="range" id="max-priceSlider" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{ isset($request['max-price']) ? $request['max-price'] : $maxPrice }}" class="ml-2 h-7">
    </label>
<script>
    // Get references to the input and slider elements
    const maxPriceInput = document.getElementById('max-price');
    const maxPriceSlider = document.getElementById('max-priceSlider');
    const minPriceInput = document.getElementById('min-price');
    const minPriceSlider = document.getElementById('min-priceSlider');
    
    // Function to update the minimum price input and slider
    function updateMinPrice() {
        // Ensure minimum price does not exceed maximum price
        if (parseFloat(minPriceInput.value) > parseFloat(maxPriceInput.value)) {
            minPriceInput.value = maxPriceInput.value;
        }
        minPriceSlider.value = minPriceInput.value;
    }

    // Function to update the maximum price input and slider
    function updateMaxPrice() {
        // Ensure maximum price does not go below minimum price
        if (parseFloat(maxPriceInput.value) < parseFloat(minPriceInput.value)) {
            maxPriceInput.value = minPriceInput.value;
        }
        maxPriceSlider.value = maxPriceInput.value;
    }

    // Add event listeners for maximum price
    maxPriceSlider.addEventListener('input', function () {
        // Update the input field's value when the slider changes
        maxPriceInput.value = maxPriceSlider.value;
        updateMinPrice(); // Call the function to update the minimum price
    });

    maxPriceInput.addEventListener('input', function () {
        // Update the slider's value when the input field changes
        maxPriceSlider.value = maxPriceInput.value;
        updateMinPrice(); // Call the function to update the minimum price
    });

    // Add event listeners for minimum price
    minPriceSlider.addEventListener('input', function () {
        // Update the input field's value when the slider changes
        minPriceInput.value = minPriceSlider.value;
        updateMaxPrice(); // Call the function to update the maximum price
    });

    minPriceInput.addEventListener('input', function () {
        // Update the slider's value when the input field changes
        minPriceSlider.value = minPriceInput.value;
        updateMaxPrice(); // Call the function to update the maximum price
    });
</script>

    <div class="relative">
        <button
            type="button"
            class="py-2 px-4 bg-slate-800 text-gray-300 rounded-md border border-slate-600 hover:bg-slate-600 focus:outline-none focus:bg-slate-800 w-full"
            id="categoriesDropdownButton"
        >
            Select Categories
        </button>

        <ul
            id="categoriesDropdown"
            class="bg-slate-800 border border-slate-600 py-1 rounded-md shadow-lg hidden w-full"
        >
            @if($categories)
                @foreach($categories as $category)
                    <li>
                        <label for="category_{{$category}}" class="pl-2 relative flex gap-2 items-center">
                            <input
                                type="checkbox"
                                id="category_{{$category}}"
                                name="categories[]"
                                value="{{$category}}"
                                class="inline float-left"
                                @if(isset($request['categories']) && in_array($category, $request['categories']))
                                    checked
                                @endif
                            >
                            {{ $category }}
                        </label>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

    <div class="relative">
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
            @if($sizes)
                @foreach($sizes as $size)
                    <li>
                        <label for="size_{{$size}}" class="pl-2 relative flex gap-2 items-center">
                            <input
                                type="checkbox"
                                id="size_{{$size}}"
                                name="sizes[]"
                                value="{{ $size }}"
                                class="inline float-left"
                                @if(isset($request['sizes']) && in_array($size, $request['sizes']))
                                    checked
                                @endif
                            >
                            {{ $size }}
                        </label>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

    <div class="relative">
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
            @if($colors)
                @foreach($colors as $color)
                    <li>
                        <label for="color_{{$color}}" class="pl-2 relative flex gap-2 items-center">
                            <input
                                type="checkbox"
                                id="color_{{$color}}"
                                name="colors[]"
                                value="{{ $color }}"
                                class="inline float-left"
                                @if(isset($request['colors']) && in_array($color, $request['colors']))
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

    <script>
        // JavaScript to toggle the dropdown menus
        document.addEventListener("DOMContentLoaded", function () {
            const categoriesDropdownButton = document.getElementById("categoriesDropdownButton");
            const categoriesDropdown = document.getElementById("categoriesDropdown");

            const sizesDropdownButton = document.getElementById("sizesDropdownButton");
            const sizesDropdown = document.getElementById("sizesDropdown");

            const colorsDropdownButton = document.getElementById("colorsDropdownButton");
            const colorsDropdown = document.getElementById("colorsDropdown");

            categoriesDropdownButton.addEventListener("click", function () {
                categoriesDropdown.classList.toggle("hidden");
            });

            sizesDropdownButton.addEventListener("click", function () {
                sizesDropdown.classList.toggle("hidden");
            });

            colorsDropdownButton.addEventListener("click", function () {
                colorsDropdown.classList.toggle("hidden");
            });

            // Close the dropdowns when clicking outside of them
            document.addEventListener("click", function (event) {
                if (!categoriesDropdownButton.contains(event.target) && !categoriesDropdown.contains(event.target)) {
                    categoriesDropdown.classList.add("hidden");
                }

                if (!sizesDropdownButton.contains(event.target) && !sizesDropdown.contains(event.target)) {
                    sizesDropdown.classList.add("hidden");
                }

                if (!colorsDropdownButton.contains(event.target) && !colorsDropdown.contains(event.target)) {
                    colorsDropdown.classList.add("hidden");
                }
            });
        });
    </script>


</form>