<!DOCTYPE html>
<html>
<head>
   <title>Wishlist</title>
   @vite('resources/js/app.js')
</head>
<body class="bg-neutral-900 text-white">
   @foreach ($wishlist as $wishlistItem)
      <p>Product: {{ $wishlistItem->name }}</p>

      <p>Price: {{ last($wishlistItem->price_history)['price'] }}</p>
      <form method="POST" action="{{ route('wishlists.destroy', ['wishlistItemId' => $wishlistItem->id]) }}" class="flex flex-col">
         @csrf
         @method('DELETE')
         <button type="submit">Remove From Wishlist</button>
      </form>
   @endforeach
</body>
</html>