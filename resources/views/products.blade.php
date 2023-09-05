<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="flex">
      @include('components.search')
      <div class="bg-neutral-900 text-white">
        @foreach ($allProducts as $product)
            <a href="/products/{{$product->slug}}">
              <p>Product: {{ $product->name }}</p>
              
              <p>Price: {{ $product->price_details['price'] }}</p>
            </a>
        @endforeach
      </div>
    </div>
</x-app-layout>