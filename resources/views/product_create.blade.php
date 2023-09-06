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
      <label>Specifications
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
      <label class="flex flex-col tracking-wider">Variant color
        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="variant_color">
      </label>
      <label class="flex flex-col tracking-wider">Variant quantity
        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="variant_quantity">
      </label>
      <label class="flex flex-col tracking-wider">Variant sizes
        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="variant_sizes">
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
</x-app-layout>