<form action="/search" method="GET" class="flex flex-col gap-4">
    <label for="categories">
        <input type="text" name="query" placeholder="Search...">
        <button type="submit">Search</button>
    </label>
    <label for="categories">Categories
        <ul id="categoriesList" class="flex flex-col">
            @if($categories)
            @foreach ( $categories as $category)
            <label for='categories[]'>
                {{ $category }}
                <input type='checkbox' name='categories[]' value='{{$category}}'>
            </label>
            @endforeach
            @endif
        </ul>
    </label>
</form>