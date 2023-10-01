<div>
    <label class="flex flex-col tracking-wider">Name  
        <input wire:input="setSlug" wire:model="name" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 ml-2 h-7" name="name">
    </label>
    <label class="flex flex-col tracking-wider">Link
        <div class="pl-2 w-full flex">
            <span>products/</span>
            <input wire:input="slugUpdated" wire:model="slug" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7 pl-0 w-full" name="slug">
        </div>
    </label>
</div>
