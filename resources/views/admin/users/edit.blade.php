<x-app-layout>

    <div class="container mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 flex-col py-4 h-[calc(100vh-4.2rem)]">

        <div class="font-bold text-3xl text-black mb-4">
            Asignar Rol
        </div>

        <div class="w-full px-4 border-2 border-gray-400 rounded-lg pb-3">

            <div class="flex border-b-2 py-5 border-gray-500">

                <div class="bg-red-800 text-white p-4 shadow-xl rounded-lg mr-2 w-1/5 text-center">
                    {{ $user->name }}
                </div>
                <div class="bg-yellow-500 text-white p-4 shadow-xl rounded-lg mr-2 w-1/2 text-center">
                    {{ $user->email }}
                </div>
                @php
                    $rolesUser = $user->getRoleNames();

                    $colorMapping = [
                        'Super Usuario' => 'bg-blue-400',
                        'Secretaria General' => 'bg-green-400',
                        'Secretaria' => 'bg-orange-400',
                    ];
                @endphp

                @foreach ($rolesUser as $role)
                    @if (array_key_exists($role, $colorMapping))
                        <div class="{{ $colorMapping[$role] }} p-4 shadow-xl rounded-lg mr-2 text-white text-center">
                            {{ $role }}
                        </div>
                    @else
                        <div class="bg-gray-400 text-white p-4 shadow-xl rounded-lg mr-2 text-center">
                            {{ $role }}
                        </div>
                    @endif
                @endforeach

            </div>


            <div class="mt-4">
                <h3 class="font-bold mb-2">Listado de carpetas en storage:</h3>
                {!! Form::open(['route' => ['rol.update', $user], 'method' => 'PUT']) !!}

                <div class="mb-2">
                    <label for="folderSelect">Selecciona una carpeta:</label>

                    <select name="folderId"
                        class="form-select block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        {!! $folderOptions !!}
                    </select>
                </div>

                {!! Form::submit('Asignar carpeta', ['class' => 'bg-blue-500 hover:bg-blue-600 mt-2 p-2 text-white rounded-lg']) !!}
                {!! Form::close() !!}
            </div>

        </div>

    </div>

</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var folderSelect = document.getElementById('folderSelect');

        // Ocultar subcarpetas al principio
        Array.from(folderSelect.querySelectorAll('option[data-parent]')).forEach(function(option) {
            option.style.display = 'none';
        });

        // Mostrar subcarpetas al seleccionar una carpeta
        folderSelect.addEventListener('change', function() {
            var selectedFolder = this.value;

            Array.from(folderSelect.querySelectorAll('option[data-parent]')).forEach(function(option) {
                option.style.display = 'none';
            });

            if (selectedFolder !== '') {
                var options = folderSelect.querySelectorAll('option[data-parent="' + selectedFolder +
                    '"]');
                options.forEach(function(option) {
                    option.style.display = 'block';
                });
            }
        });
    });
</script>
