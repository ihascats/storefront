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
  @endforeach
  <form method="POST" action="{{ route('carts.store') }}" class="flex flex-col">
      @csrf
      <button>Submit</button>
   </form>
</body>
</html>