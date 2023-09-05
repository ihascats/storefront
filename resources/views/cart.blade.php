<!DOCTYPE html>
<html>
<head>
   <title>cart</title>
   @vite('resources/js/app.js')
</head>
<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
         {{ __('Cart') }}
      </h2>
   </x-slot>
   <div class="bg-neutral-900 text-white">
      @foreach ($cart as $cartItem)
         @if(isset($cartItem['product']->name))
            <p>Product: {{ $cartItem['product']->name }}</p>
            <p>Quantity: {{ $cartItem['quantity'] }}</p>
            <p>Product Price: {{ last($cartItem['product']->price_history)['price'] }}</p>
            <p>Total Price: {{ last($cartItem['product']->price_history)['price'] * $cartItem['quantity'] }}</p>
            <form method="POST" action="{{ route('carts.destroy', ['cart' => $cartItem['product']->id]) }}" class="flex flex-col">
               @csrf
               @method('DELETE')
               <button type="submit">Remove From Cart</button>
            </form>
         @endif
      @endforeach
   </div>
</x-app-layout>