<x-app-layout>
    <div class="container mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 flex-col py-4 h-[calc(100vh-4.2rem)] w-full">
        <form action="{{ route('upload') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            <input type="file" name="files[]" multiple>
            <input type="text" hidden value="{{$folder->id}}" name="parent">
            <button type="submit">Subir Archivos</button>
        </form>
    </div>
</x-app-layout>
