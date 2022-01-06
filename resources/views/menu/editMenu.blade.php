<x-app-layout>
@foreach($menus as $menu)
    <x-slot name="header">
        {{ __('Editar el menú')}} <i>{{$menu->name}}</i>
    </x-slot>

    @if ($message = Session::get('success'))
    <div class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-center w-12 bg-green-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                </path>
            </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-green-500">Éxito</span>
                <p class="text-sm text-gray-600">{{ $message }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="p-4 bg-white rounded-lg shadow-md">

    <form action="{{ route('menus.updateMenu', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            
            <div class="mt-4">
                <x-label for="name" :value="__('Nombre del menú')"/>
                <x-input type="text"
                         id="name"
                         name="name"
                         class="block w-full"
                         value="{{$menu->name}}"
                         required>
                </x-input>
                @error('name')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="description" :value="__('Descripción del menú')"/>
                <x-input type="text"
                         id="description"
                         name="description"
                         class="block w-full"
                         value="{{$menu->description}}"
                         required/>
                @error('name')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="image" :value="__('Imagen del menú')"/>
                <x-input type="file"
                         id="image"
                         name="image"
                         class="block w-full"
                         required/>
                <img aria-hidden="true" class="object-contain h-48 w-96" src="{{ asset('/storage/images/') }}/{{$menu->id}}/{{$menu->image}}" alt="Office">
                <img aria-hidden="true" class="hidden object-cover w-50 h-50 dark:block" src="{{ asset('../storage/images/') }}/{{$menu->id}}/{{$menu->image}}">
                @error('name')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            @endforeach
            <div class="mt-4">
            <a href="{{ route('menus.updateMenu', $menu->id) }}">
                <x-button class="block w-full">
                    {{ __('Actualizar') }}
                </x-button>
            </div>
        </form>

    </div>
</x-app-layout>