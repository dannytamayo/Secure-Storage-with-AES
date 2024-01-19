<x-app-layout>
    <div class="container mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 flex-col py-4 h-[calc(100vh-4.2rem)] w-full">

        <div class="flex justify-center">

            <div class="bg-white rounded-md shadow-md p-6 w-2/4">
                <h2 class="text-2xl font-semibold mb-4">Subir Archivos a {{ $folder->name }}</h2>
                
                {!! Form::open(['route' => 'upload', 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'space-y-4']) !!}
                
                <div class="flex items-center space-x-4">
                    {!! Form::file('files[]', ['class' => 'border rounded-md p-2 flex-grow', 'multiple' => true]) !!}
                    {!! Form::hidden('parent', $folder->id) !!}
                    {!! Form::submit('Subir Archivos', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) !!}
                </div>
                
                {!! Form::close() !!}
            </div>
        </div>

    </div>
</x-app-layout>

