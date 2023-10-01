<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Create New Product') }}
    </h2>
  </x-slot>
  <div class="text-white p-4 max-w-7xl mx-auto">
    @livewire('create-new-product-form-element')
  </div>
  <div class="bg-red-600"><div>
</x-app-layout>