<x-app-layout>
    <x-slot name="header">
        {{ __('Menús') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">

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

        <div class="inline-flex overflow-hidden mb-4 bg-white rounded-lg shadow-md">

            <div class="flex justify-center items-center w-12 bg-blue-500">
                <a href="{{ route('menu.show') }}"><i class="fa fa-plus" style="font-size: 30px; color:black"></i></a>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <a href="{{ route('menu.show') }}">
                        <span class="font-semibold text-blue-500">Agregar un menú</span>
                        <p class="text-sm text-gray-600">Añade un nuevo menú a la lista.</p>
                </div>
                </a>
            </div>

        </div>

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Descripcion</th>
                            <th class="px-4 py-3">Imagen</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($menus as $menu)

                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ $menu->name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $menu->description }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="md:h-auto md:w-1/4" bis_skin_checked="1">
                                    <img aria-hidden="true" class="object-cover w-8 h-8 rounded-full" src="{{ asset('../storage/images/menus') }}/{{$menu->id}}/{{$menu->image}}" alt="Office">
                                    <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="{{ asset('../storage/images/menus') }}/{{$menu->id}}/{{$menu->image}}" alt="Office">
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="mt-4">
                                    <a href="{{ route('menu.showSpecific', $menu->id) }}"  >
                                        <x-button class="block w-full">
                                            {{ __('Ver') }}
                                        </x-button>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="mt-4">
                                    <a href="{{ route('menus.viewEdit', $menu->id) }}"> 
                                            <x-button class="block w-full">
                                                {{ __('Editar') }}
                                            </x-button>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="mt-4">
                                    <a href="{{ route('menu.delete', $menu->id) }}" onclick="return confirm('¿Estás seguro que deseas eliminar este menú?')">
                                        <x-button class="block w-full">
                                            {{ __('Borrar') }}
                                        </x-button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $menus->links() }}
            </div>
        </div>

    </div>
</x-app-layout>