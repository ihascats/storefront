<form wire:submit="save" class="flex flex-col gap-3">
    @csrf
    @livewire('product-name-slug')
    
    <label class="flex flex-col tracking-wider">Description  
    <textarea class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2" name="description" rows="4" cols="50" wire:model="description" wire:input="updateDescription"></textarea>
    </label>
    @livewire('product-specifications')
    @livewire('product-variant-create')
    @livewire('product-categories-select')

    <input class="h-36 w-36 flex-wrap overflow-hidden text-red-500" hidden>
    <button class="bg-green-600 rounded-md py-2 text-3xl tracking-wider" type="submit">Submit</button>
</form>
