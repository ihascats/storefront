<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
         {{ __('Wishlist') }}
      </h2>
   </x-slot>
   <div class="bg-neutral-900 text-white">
      @foreach ($wishlist as $wishlistItem)
         @if(isset($wishlistItem->name))
            <p>Product: {{$wishlistItem->name}}</p>
            <p>Price: {{$wishlistItem->price_details['price']}}</p>
            <form method="POST" action="{{ route('wishlists.destroy', ['wishlistItemId' => $wishlistItem->id]) }}" class="flex flex-col">
               @csrf
               @method('DELETE')
               <button type="submit">Remove From Wishlist</button>
            </form>
         @endif
      @endforeach
   </div>
</x-app-layout>