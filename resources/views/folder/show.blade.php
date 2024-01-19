<x-app-layout>

    @if (session('info'))
        <div id="alert" role="alert" class="mb-6 absolute top-20 left-28 right-28 z-50">
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Error
            </div>
            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                <p>{{ session('info') }}</p>
            </div>
        </div>
    @endif


    <div class="container mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 flex-col py-4 h-[calc(100vh-4.2rem)] w-full">

        @livewire('modal-create-folder', ['folder' => $folder])

        <h1>{{$currentFolderPath}}</h1>

        <br>

        @if (count($folders) > 0 || count($files) > 0)


            <div class="grid grid-cols-6 gap-4">

                @foreach ($folders as $folder)
                    <a href="{{ route('folder.show', $folder->id) }}">


                        <x-card-folder :folder="$folder" />

                    </a>
                @endforeach

                @foreach ($files as $file)
                    <a href="{{ route('file.download', $file->id) }}">
                        <x-card-file :file="$file" />
                    </a>
                @endforeach

            </div>
        @else
            <div class="h-[calc(100vh-10rem)] flex items-center justify-center font-bold text-2xl">
                No hay carpetas o archivos aun
            </div>

        @endif



    </div>

</x-app-layout>

<script>
    // Espera a que el DOM esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Encuentra la alerta por su ID
        var alert = document.getElementById('alert');

        // Si la alerta existe
        if (alert) {
            // Aplica una transición de opacidad
            alert.style.transition = 'opacity 2s';

            // Inicia la animación después de un pequeño retraso (opcional)
            setTimeout(function() {
                // Cambia la opacidad a 0
                alert.style.opacity = '0';
            }, 2000);

            // Oculta la alerta después de 3000 milisegundos (3 segundos)
            setTimeout(function() {
                alert.style.display = 'none';
            }, 5000); // 1000 (para la animación) + 3000 (para ocultar completamente)
        }
    });;
</script>
