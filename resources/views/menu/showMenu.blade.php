<x-app-layout>
    @foreach($menus as $menu)
    <x-slot name="header">
        {{ __('Ver el menú')}} <i>{{$menu->name}}</i>
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-md">
        <div class="mt-4">
            <x-label for="name" :value="__('Nombre del menú')" />
            <x-input type="text" id="name" name="name" class="block w-full" value="{{$menu->name}}" disabled>
            </x-input>
            @error('name')
            <span class="text-xs text-red-600 dark:text-red-400">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="description" :value="__('Descripción del menú')" />
            <x-input type="text" id="description" name="description" class="block w-full disabled:opacity-75" value="{{$menu->description}}" disabled />
            @error('name')
            <span class="text-xs text-red-600 dark:text-red-400">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="mt-4">
            <x-label for="image" :value="__('Imagen del menú')" />
            
            <img aria-hidden="true" class="object-contain h-48 w-96" src="{{ asset('/storage/images/') }}/{{$menu->id}}/{{$menu->image}}" alt="Office">
            <img aria-hidden="true" class="hidden object-cover w-50 h-50 dark:block" src="{{ asset('../storage/images/') }}/{{$menu->id}}/{{$menu->image}}">
            @error('name')
            <span class="text-xs text-red-600 dark:text-red-400">
                {{ $message }}
            </span>
            @enderror
        </div>
        @endforeach
    </div>
</x-app-layout>