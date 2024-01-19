<x-app-layout>
        
    <div class="container mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 flex-col py-4 h-[calc(100vh-4.2rem)]">
        <div class="w-full flex justify-end px-4">
            <a href="{{ route('rol.create') }}" class="bg-blue-500 rounded-lg p-2 text-white hover:bg-blue-600">Crear</a>
        </div>

        @livewire('admin-users')

    </div>

</x-app-layout>