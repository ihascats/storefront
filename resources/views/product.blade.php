<!DOCTYPE html>
<html>
<head>
   <title>Product</title>
   @vite('resources/js/app.js')
</head>
<body class="bg-neutral-900 text-white">
   <h1>TOTAL QUANTITY: {{$total_quantity}}</h1>
   <h1>Price: ${{$price}}</h1>
   <h1>Name: {{$product->name}}</h1>
   <h1>id: {{$product->id}}</h1>
   <div>Description: {{$product->description}}</div>
   @foreach ($product->specifications as $spec)
      <div class="flex flex-row gap-2">
         <div>{{$spec['name']}}</div>
         <div>{{$spec['description']}}</div>
      </div>
   @endforeach
   @foreach ($product->price_history as $price_history)
      <div>Price: {{$price_history['price']}}</div>
      <div>Date of when the price was set:{{$price_history['date']->toDateTime()->format("d M Y")}}</div>
      <div>Was the discount applied: {{$price_history['discount'] ? 'yes' : 'no'}}</div>
   @endforeach
   @foreach ($product->discount as $discount)
      <div>{{$discount}}</div>
   @endforeach
   <div>Wishlist count: {{$product->wishlist_count}}</div>
   <h1>Categories:</h1>
   <div class="pl-2">{{implode(', ', $product->categories)}}</div>
   </ul>
   @foreach ($product->variants as $variant)
      <div>Color: {{$variant['color']}}</div>
      <div>quantity: {{$variant['quantity']}}</div>
      <h1>Sizes:</h1>
      <ul class="pl-3">
         <div>{{implode(', ', $variant['sizes'])}}</div>
      </ul>
   @endforeach
</body>
</html>