<form action="/search" method="GET" class="flex flex-col gap-4">
    <label for="query">
        <input type="text" name="query" placeholder="Search...">
        <button type="submit">Search</button>
    </label>
    <label for="min-price" class="flex flex-col">Min Price:
        <input type="number" name="min-price" id="min-price" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{$minPrice}}">
        <input type="range" name="min-priceSlider" id="min-priceSlider" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{$minPrice}}">
    </label>
    <label for="max-price" class="flex flex-col">Max Price:
        <input type="number" name="max-price" id="max-price" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{$maxPrice}}">
        <input type="range" name="max-priceSlider" id="max-priceSlider" step="0.01" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{$maxPrice}}">
    </label>
    <script>
        // Get references to the input and slider elements
        const maxPriceInput = document.getElementById('max-price');
        const maxPriceSlider = document.getElementById('max-priceSlider');
        const minPriceInput = document.getElementById('min-price');
        const minPriceSlider = document.getElementById('min-priceSlider');
        
        // Add an event listener to the slider
        maxPriceSlider.addEventListener('input', function () {
            // Update the input field's value when the slider changes
            maxPriceInput.value = maxPriceSlider.value;
        });

        // Add an event listener to the input field
        maxPriceInput.addEventListener('input', function () {
            // Update the slider's value when the input field changes
            maxPriceSlider.value = maxPriceInput.value;
        });
        // Add an event listener to the slider
        minPriceSlider.addEventListener('input', function () {
            // Update the input field's value when the slider changes
            minPriceInput.value = minPriceSlider.value;
        });

        // Add an event listener to the input field
        minPriceInput.addEventListener('input', function () {
            // Update the slider's value when the input field changes
            minPriceSlider.value = minPriceInput.value;
        });
    </script>
    
    <label for="categories">Categories</label>
    <ul id="categoriesList" class="flex flex-col">
        @if($categories)
        @foreach($categories as $category)
        <label for="category_{{$category}}">
            {{ $category }}
            <input type="checkbox" id="category_{{$category}}" name="categories[]" value="{{$category}}">
        </label>
        @endforeach
        @endif
    </ul>


    <label for="sizes">Sizes
        <ul>
            @if($sizes)
                @foreach($sizes as $size)
                    <li>
                        <label for="sizes[]">
                            {{ $size }}
                            <input type="checkbox" name="sizes[]" value="{{ $size }}">
                        </label>
                    </li>
                @endforeach
            @endif
        </ul>
    </label>

    <label for="colors">Colors
        <ul>
            @if($colors)
                @foreach($colors as $color)
                    <li>
                        <label for="colors[]">
                            {{ $color }}
                            <input type="checkbox" name="colors[]" value="{{ $color }}">
                        </label>
                    </li>
                @endforeach
            @endif
        </ul>
    </label>
</form>
