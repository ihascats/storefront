<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Create New Product') }}
    </h2>
  </x-slot>
  <div class="text-white p-4 max-w-7xl mx-auto">
    <form  method="POST" action="{{ route('products.store') }}" class="flex flex-col gap-3">
      @csrf
      @livewire('product-name-slug')
      
      <label class="flex flex-col tracking-wider">Description  
        <textarea class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2" name="description" rows="4" cols="50"></textarea>
      </label>
      @livewire('product-specifications')
      @livewire('product-variant-create')
      @livewire('product-categories-select')

      <input id="user-timezone" name="localTimezone" class="h-36 w-36 flex-wrap overflow-hidden" hidden>

      <script>
         // Detect and store the user's timezone in a JavaScript variable
         var userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
         if (document.querySelector('#user-timezone'))
            document.querySelector('#user-timezone').value = userTimeZone;
      </script>
      <button class="bg-green-600 rounded-md py-2 text-3xl tracking-wider">Submit</button>
    </form>
  </div>
  <div class="bg-red-600"><div>
</x-app-layout>