<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
         {{ $product->name }}
      </h2>
   </x-slot>
   <div class="bg-neutral-900 text-white p-4 max-w-7xl mx-auto">
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
      <div>Price: {{$price}}</div>
      
      @if(auth()->user()->admin)
      <p>Users Timezone: <span id="user-timezone"></span></p>
      @endif

      <script>
         // Detect and store the user's timezone in a JavaScript variable
         var userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
         if (document.querySelector('#user-timezone'))
            document.querySelector('#user-timezone').textContent = userTimeZone;
         
         // Set a cookie with the user's timezone
         document.cookie = "user_timezone=" + userTimeZone + "; path=/";
      </script>

      @php
         $userTimeZone = 'Europe/Belgrade'; // Default to 'Europe/Belgrade' if userTimeZone is not provided
         if(isset($_COOKIE['user_timezone'])) {
            $userTimeZone = $_COOKIE['user_timezone'];
         }
         
         $expirationDateUTC = $product->price_details["discount_exp_date"]->toDateTime();
         $expirationDateLocal = $product->price_details["discount_exp_date"]->toDateTime()->setTimezone(new DateTimeZone($userTimeZone));
         $currentDate = now()->timezone($userTimeZone); // Current date and time in user's timezone
      @endphp

      {{-- <p>Expiration Date (UTC): {{$expirationDateUTC->format('Y-m-d H:i:s')}} ({{$expirationDateUTC->getTimezone()->getName()}})</p>
      <p>Expiration Date (Local): {{$expirationDateLocal->format('Y-m-d H:i:s')}} ({{$expirationDateLocal->getTimezone()->getName()}})</p>
      <p>Current Date: {{$currentDate->format('Y-m-d H:i:s')}} ({{$currentDate->getTimezone()->getName()}})</p> --}}

      @if($product->price_details["discount"] > 0 && $expirationDateLocal > $currentDate)
         <div>Discount: {{$product->price_details["discount"]}}</div>
         @php
            $discountedPrice = $product->price_details["price"] - ($product->price_details["price"] * ($product->price_details["discount"] / 100));
            $discountedPriceFormatted = number_format($discountedPrice, 2);
         @endphp
         <div>Price after discount: {{$discountedPriceFormatted}}</div>
         <div>Discount Expiration Date: {{$expirationDateLocal->format('Y-m-d H:i:s')}}</div>
      @endif
      
      <div>Wishlist count: {{$product->wishlist_count}}</div>
      <h1>Categories:</h1>
      <div class="pl-2">{{implode(', ', $product->categories)}}</div>
      </ul>
      @foreach ($product->variants as $variant)
         <div>Color: {{$variant['color']}}</div>
         <div>quantity: {{$variant['quantity']}}</div>
         <div>Sizes: {{$variant['sizes']}}</div>
      @endforeach
      <form  method="POST" action="{{ route('carts.store') }}" class="flex flex-col">
         @csrf
         <input name="product_id" value={{$product->id}} class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7">
         <input name="quantity" value='1' type="number" min="0" max={{$total_quantity}} class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7">
         <button>Add To Cart</button>
      </form>
      <form  method="POST" action="{{ route('wishlists.store') }}" class="flex flex-col">
         @csrf
         <input name="product_id" value={{$product->id}} class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7">
         <button>Add To Wishlist</button>
      </form>
   </div>
</x-app-layout>