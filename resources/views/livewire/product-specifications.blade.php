<label class="tracking-wider">Specifications
    <ul class="pl-2" id="specList">
        <li class="flex items-end gap-2">
            <label class="flex flex-col tracking-wider w-full text-sm">name  
                <input wire:model="newSpec.name" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7" name="spec_name" id="spec_name">
            </label>
            <label class="flex flex-col tracking-wider w-full text-sm">description
                <input wire:model="newSpec.description" class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7" name="spec_desc" id="spec_desc">
            </label>
            <button wire:click="addSpec" id="addSpec" type="button" class="bg-orange-600 rounded-md px-4 h-7">add</button>
        </li>
        @foreach($specs as $index => $spec)
            @if(!isset($spec["deleted"]))
                <li class="flex items-end gap-2">
                    <label class="flex flex-col tracking-wider w-full text-sm">name  
                        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7" name="specifications[][name]" value="{{$spec['name']}}">
                    </label>
                    <label class="flex flex-col tracking-wider w-full text-sm">description
                        <input class="bg-white/10 border-l-0 border-r-0 border-t-0 border-b-2 h-7" name="specifications[][description]" value="{{$spec['description']}}">
                    </label>
                    <button wire:click="removeSpec({{$index}})" type="button" class="bg-red-600 rounded-md px-4 h-7">del</button>
                </li>
            @endif
        @endforeach
    </ul>
</label>