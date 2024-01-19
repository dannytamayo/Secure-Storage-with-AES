<div class="container mx-auto p-4">

    <div class="bg-white shadow-md rounded my-2">
        <div class="p-4">   
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->id }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{$user->email}}</td>
                            <td class="border px-4 py-2 w-10">
                                    <a href="{{ route('rol.edit', $user) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Administrar</a>
                            </td>
                            {{-- <td class="border px-4 py-2 w-10">
                                    <form action="{{ route('rol.destroy', $user) }}" method="POST">
                                    @csrf

                                    @method('DELETE')
                                    
                                    <button class="bg-red-500 text-white px-2 py-1 rounded">Editar</button>
                                </form>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{$users->links()}}
    </div>

</div>
