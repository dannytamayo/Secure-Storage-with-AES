<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folders = Folder::whereNull('parent_id')->get();
        // dd($folders);

        return view('folder.index', compact('folders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $nombreCarpeta = strtoupper($request->input('name'));


        $carpetaPadreId = $request->input('parent_id');

        $carpetasHijas = Folder::where('parent_id', $carpetaPadreId)->get();

        $folders = [];

        $create = true;


        foreach ($carpetasHijas as $carpeta) {

            if ($carpeta->name === $nombreCarpeta) {
                $create = false;
            }
        }

        if ($create) {

            $nodoActual = Folder::find($carpetaPadreId);


            while ($nodoActual !== null) {

                array_push($folders, $nodoActual->name);;
                $nodoActual = Folder::find($nodoActual->parent_id);
            }

            $folders = array_reverse($folders);
            array_push($folders,  $nombreCarpeta);

            $folder = Folder::create([
                'name' => $nombreCarpeta,
                'parent_id' => $carpetaPadreId
            ]);

            $folderPath = join("/", $folders);

            $folderSuccess = Storage::makeDirectory($folderPath);

            if ($folder && $folderSuccess) {

                $folder = Folder::find($carpetaPadreId);

                if ($folder) {

                    return redirect()->route('folder.show', $folder);

                }else{

                    return redirect()->route('folder.index');

                }

            }
        } else {

            $folder = Folder::find($carpetaPadreId);

            if ($folder) {
                return redirect()->route('folder.show', $folder)->with('info', 'Ya existe una carpeta con ese nombre');
            }else{
                return redirect()->route('folder.index')->with('info', 'Ya existe una carpeta con ese nombre');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Folder $folder)
    {


        $folders = Folder::where('parent_id', $folder->id)->get();


        return view('folder.show', compact('folders', 'folder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
        $parentFolderId = $folder->parent_id;

        // Elimina la carpeta del almacenamiento
        $folderPath = $this->getFolderPath($folder);
        Storage::deleteDirectory($folderPath);

        // Elimina la carpeta de la base de datos
        $folder->delete();

        // Redirige a la ruta deseada
        if ($parentFolderId !== null) {

            $folder = Folder::find($parentFolderId);

            return redirect()->route('folder.show', $folder);
        } else {
            return redirect()->route('folder.index');
        }
    }

    // Método auxiliar para obtener la ruta completa de la carpeta en el almacenamiento
    private function getFolderPath(Folder $folder)
    {
        $folders = [];

        $currentFolder = $folder;

        while ($currentFolder !== null) {
            array_push($folders, $currentFolder->name);
            $currentFolder = Folder::find($currentFolder->parent_id);
        }

        return join('/', array_reverse($folders));
    }

  
}
