<form action="/search" method="GET" class="flex flex-col gap-2 text-white p-2">
    @csrf
    <label for="query">
        <input type="text" name="query" placeholder="Search..." value="{{ isset($request['query']) ? $request['query'] : '' }}" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-10">
        <button type="submit">Search</button>
    </label>
    <label for="min-price" class="flex flex-col">Min Price:
        <input type="number" name="min-price" id="min-price" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{ isset($request['min-price']) ? $request['min-price'] : $minPrice }}" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7">
        <input type="range" name="min-priceSlider" id="min-priceSlider" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{ isset($request['min-price']) ? $request['min-price'] : $minPrice }}" class="ml-2 h-7">
    </label>
    <label for="max-price" class="flex flex-col">Max Price:
        <input type="number" name="max-price" id="max-price" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{ isset($request['max-price']) ? $request['max-price'] : $maxPrice }}" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7">
        <input type="range" name="max-priceSlider" id="max-priceSlider" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{ isset($request['max-price']) ? $request['max-price'] : $maxPrice }}" class="ml-2 h-7">
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

    <label for="categories">Categories</label>
    <ul id="categoriesList" class="flex flex-col">
        @if($categories)
            @foreach($categories as $category)
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

            @endforeach
        @endif
    </ul>



    <label for="sizes">Sizes</label>
    <ul>
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


    <label for="colors">Colors</label>
    <ul>
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

</form>