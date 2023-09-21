<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="flex">
      @include('components.search')
      <div class="bg-neutral-900 text-white p-4 max-w-7xl w-full">
        @foreach ($allProducts as $product)
            <a href="/products/{{$product->slug}}">
              <p>Product: {{ $product->name }}</p>
              @if($product->lowest_price < $product->highest_price)
                <p>Starting at: {{ $product->lowest_price }}</p>
              @else
                <p>Price: {{ $product->highest_price }}</p>
              @endif
            </a>
        @endforeach
      </div>
    </div>
</x-app-layout>