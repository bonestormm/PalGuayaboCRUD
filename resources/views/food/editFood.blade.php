<x-app-layout>
@foreach($menus as $menu)
    <x-slot name="header">
        {{ __('Editar la comida')}} <i>{{$menu->name}}</i>
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

    <form action="{{ route('food.updateFood', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mt-4">
                <x-label for="name" :value="__('Menú al que pertenece')" />

                <select name="menu" class="block w-full rounded-md mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    @foreach($menus as $food)
                    <option value="{{$food->id}}">{{$food->name}}</option>
                    @endforeach
                </select>
                @error('name')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
                @enderror
            </div>
            
            <div class="mt-4">
                <x-label for="name" :value="__('Nombre de la comida')" />
                <x-input type="text" id="name" name="name" class="block w-full" required />
                @error('name')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="description" :value="__('Descripción de la comida')" />
                <x-input type="text" id="description" name="description" class="block w-full" required />
                @error('name')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
                @enderror
            </div>
            
            <div class="mt-4">
                <x-label for="price" :value="__('Precio de la comida')" />
                <x-input type="number" id="price" name="price" class="block w-full" min="0" required />
                @error('name')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="image" :value="__('Imagen de la comida')" />
                <x-input type="file" id="image" name="image" class="block w-full" required />
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