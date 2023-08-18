<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
         {{ __('Wishlist') }}
      </h2>
   </x-slot>
   <div class="bg-neutral-900 text-white">
      @foreach ($wishlist as $wishlistItem)
         <p>Product: {{ $wishlistItem->name }}</p>

         <p>Price: {{ last($wishlistItem->price_history)['price'] }}</p>
         <form method="POST" action="{{ route('wishlists.destroy', ['wishlistItemId' => $wishlistItem->id]) }}" class="flex flex-col">
            @csrf
            @method('DELETE')
            <button type="submit">Remove From Wishlist</button>
         </form>
      @endforeach
   </div>
</x-app-layout>