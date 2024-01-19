<x-app-layout>

    <div class="container mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 flex-col py-4 h-[calc(100vh-4.2rem)]">

        <div class="grid grid-cols-2">


            <div class="h-[calc(100vh-6.2rem)] w-full flex flex-row justify-center items-center px-4">
                <a href="{{ route('rol.index') }}"
                    class="max-w-sm block rounded-lg overflow-hidden shadow-lg border-4 border-red-800 hover:scale-105 transition-transform duration-300 w-full">
                    <div class="w-full flex justify-center p-4">
                        <img class="w-40 h-40" src="{{asset('images/man.png')}}" alt="Sunset in the mountains">
                    </div>
                    <div class="px-6">
                        <div class="font-bold text-xl mb-2 text-center">Usuarios</div>
                    </div>
                </a>

            </div>
            <div class="h-[calc(100vh-6.2rem)] w-full flex flex-row justify-center items-center">
                <a href="{{ route('folder.index') }}"
                    class="max-w-sm block rounded-lg overflow-hidden shadow-lg border-4 border-red-800 hover:scale-105 transition-transform duration-300 w-full">
                    <div class="w-full flex justify-center p-4">
                        <img class="w-40 h-40" src="{{asset('images/folders.png')}}" alt="Sunset in the mountains">
                    </div>
                    <div class="px-6">
                        <div class="font-bold text-xl mb-2 text-center">Carpetas</div>
                    </div>
                </a>
            </div>
       



        </div>

    </div>

</x-app-layout>
