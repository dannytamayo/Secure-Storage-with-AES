<div>

    <div class="flex justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-5"
            wire:click="openModal">Crear carpeta</button>

        @if (request()->path() != 'dashboard/folder')
            <form action="{{ route('upload.files', $folder != null ? $folder->id : '') }}" method="GET">
                @csrf
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-5"
                    type="submit">Subir archivo</button>
            </form>
        @endif

    </div>

    @if ($showModal)
        <div class="modal-overlay" wire:click="closeModal"></div>

        <div
            class="modal-container fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-8 rounded shadow-md transition-transform duration-300 opacity-100">
            <!-- Botón de cierre (x) en la esquina superior derecha -->
            <button class="text-2xl font-weight-bold text-gray-500 absolute top-0 right-0 mr-2  hover:text-red-500"
                wire:click="closeModal">×</button>

            <form class="w-full max-w-sm" method="POST" action="{{ route('folder.store') }}">

                @csrf

                <div class="flex items-center border-b border-blue-500 py-2">
                    <input name="name"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                        type="text" placeholder="Nombre de la carpeta" aria-label="Full name">
                    <input type="text" hidden name="parent_id" value="{{ $folder != null ? $folder->id : '' }}">
                    <button
                        class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded"
                        type="submit">
                        CREAR
                    </button>

                </div>
            </form>
        </div>
    @endif
</div>
