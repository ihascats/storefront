<!DOCTYPE html>
<html>
<head>
   <title>cart</title>
   @vite('resources/js/app.js')
</head>
<body class="bg-neutral-900 text-white">
  @foreach ($cart as $cartItem)
      <p>Product: {{ $cartItem['product']->name }}</p>
      <p>Quantity: {{ $cartItem['quantity'] }}</p>
      <p>Product Price: {{ last($cartItem->price_history)['price'] }}</p>
      <p>Total Price: {{ last($cartItem->price_history)['price'] * $cartItem['quantity'] }}</p>
  @endforeach
  <form method="POST" action="{{ route('carts.store') }}" class="flex flex-col">
      @csrf
      <button>Submit</button>
   </form>
</body>
</html>