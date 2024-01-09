@props(['folder'])

<article class="flex flex-col justify-center items-center h-44 w-full p-8 bg-gray-200 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300 relative">
    <form method="POST" action="{{ route('folder.destroy', $folder) }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta carpeta?');">
        @csrf
        @method('DELETE')

        <button type="submit" class="absolute top-2 right-2  hover:text-red-700 text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 30 30">
                <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"></path>
            </svg>
        </button>
    </form>

    <span class="text-black mt-2 font-bold">{{$folder->name}}</span>
    <img src="{{ asset('images/folder.svg') }}" alt="">
</article>


