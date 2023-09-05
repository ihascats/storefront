<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Create New Product') }}
    </h2>
  </x-slot>
  <div class="bg-neutral-900 text-white">
    <form  method="POST" action="{{ route('products.store') }}" class="flex flex-col">
      @csrf
      <label>Name  
        <input name="name">
      </label>
      <label>Slug  
        <input name="slug">
      </label>
      <label>Price  
        <input name="price">
      </label>
      <label>Currency  
        <input name="currency">
      </label>
      <label>Description  
        <input name="description">
      </label>
      <label>Specification name  
        <input name="specification_name">
      </label>
      <label>Specification description
        <input name="specification_description">
      </label>
      <label>Discount
        <input name="discount">
      </label>
      <label>Discount exp date
        <input name="discount_exp_date">
      </label>
      <label>Variant color
        <input name="variant_color">
      </label>
      <label>Variant quantity
        <input name="variant_quantity">
      </label>
      <label>Variant sizes
        <input name="variant_sizes">
      </label>
      <label for="new_category">
        New Category
        <input name="new_category" id="new_category" type="text">
        <button id="addCategory" type="button">
          add
        </button>
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
      <button>Submit</button>
    </form>
  </div>
</x-app-layout>