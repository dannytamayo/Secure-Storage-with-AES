<x-app-layout>

    <div class="container mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 flex-col py-4 h-[calc(100vh-4.2rem)]">

        <div class="max-w-md mx-auto bg-white rounded p-6 shadow-md">
            <form action="{{ route('folder.store') }}" method="POST">
                @csrf
        
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                    <input type="text" id="name" name="name" required
                           class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>
        
                <div class="mb-4">
                    <label for="parent_id" class="block text-gray-700 text-sm font-bold mb-2">Selecciona la carpeta contenedora de esta nueva:</label>
                    <select id="parent_id" name="parent_id" class="w-full p-2 border rounded-md focus:outline-none focus:border-blue-500">
                        <option value="" disabled selected>Seleccione:</option>
                        <!-- Itera sobre los datos enviados desde el controlador para llenar las opciones -->
                        @foreach($carpetas as $carpeta)
                            <option value="{{ $carpeta->id }}">{{ $carpeta->name }}</option>
                        @endforeach
                    </select>
                </div>
        
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue">
                    Enviar
                </button>
            </form>
        </div>

    </div>

</x-app-layout>