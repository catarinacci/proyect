@php
    //$i = $getItems();
    $comments = $getItemsc();
    $reactions = $getItemsl();
    //dd($a[0]->id)
    //dd($getItemsc()->count())

@endphp


<div class="relative flex w-full max-w-[26rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
    <div
        class="relative mx-4 overflow-hidden text-white shadow-lg rounded-xl bg-blue-gray-500 bg-clip-border shadow-blue-gray-500/40">
        <img src={{ $getItems()['image_note_path'] }} 
            alt="ui/ux review check" />
        <div
            class="absolute inset-0 w-full h-full to-bg-black-10 bg-gradient-to-tr from-transparent via-transparent to-black/60">
        </div>
    </div>
    <div class="p-6">
        <div class="flex items-center justify-between mb-3">
            <h5 class="block font-sans text-xl antialiased font-medium leading-snug tracking-normal text-blue-gray-900">
                {{ $getItems()['title'] }} 
            </h5>
        </div>
        <p class="block font-sans text-base antialiased font-light leading-relaxed text-gray-700">
            {{ $getItems()['content'] }} 
        </p>
        <div class="inline-flex flex-wrap items-center gap-3 mt-8 group">
            <x-filament::dropdown>
                <x-slot name="trigger">
                    <x-filament::button>
                        Comments ( {{ $getItemsc()->count() }} )
                    </x-filament::button>
                </x-slot>

                @foreach ($comments as $item)
                <x-filament::dropdown.list>
                    <x-filament::dropdown.list.item wire:click="openViewModal">
                        {{ $item['content'] }}
                    </x-filament::dropdown.list.item>
                </x-filament::dropdown.list>
                @endforeach
                
            </x-filament::dropdown>

            <x-filament::dropdown>
                <x-slot name="trigger">
                    <x-filament::button>
                        Likes
                    </x-filament::button>
                </x-slot>
        
                @foreach ($reactions as $item)
                <x-filament::dropdown.list>
                    <x-filament::dropdown.list.item wire:click="openViewModal">
                        {{ $item['mensaje'] }}
                    </x-filament::dropdown.list.item>
                </x-filament::dropdown.list>
                @endforeach

            </x-filament::dropdown>
        </div>
    </div>
</div>
