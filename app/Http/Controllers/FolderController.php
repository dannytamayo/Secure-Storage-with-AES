<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user =  Auth::user();

        $rol = $user->getRoleNames()[0];

        $folders = array();

        $currentFolderPath = '/';
        if ($rol === 'Super Usuario') {
            $folders = Folder::whereNull('parent_id')->get();
            $files = [];
        } else {
            $rootFolder = $user->permissions[0];
            $folders = Folder::where('parent_id', '=', $rootFolder->folder_id)->get();
            $files = File::where('parent_id', '=', $rootFolder->folder_id)->get();
            $fs = array();
            $nodoActual = Folder::find($rootFolder->folder_id);

            while ($nodoActual !== null) {

                array_push($fs, $nodoActual->name);;
                $nodoActual = Folder::find($nodoActual->parent_id);
            }

            $fs = array_reverse($fs);



            $currentFolderPath = '/' . join("/", $fs);
        }




        return view('folder.index', compact('folders', 'files', 'currentFolderPath'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //    return view('dashboard');
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
                } else {

                    return redirect()->route('folder.index');
                }
            }
        } else {

            $folder = Folder::find($carpetaPadreId);

            if ($folder) {
                return redirect()->route('folder.show', $folder)->with('info', 'Ya existe una carpeta con ese nombre');
            } else {
                return redirect()->route('folder.index')->with('info', 'Ya existe una carpeta con ese nombre');
            }
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Folder $folder)
    {
        $user = Auth::user();
        $rol = $user->getRoleNames()[0];
        if ($rol === 'Super Usuario') {
        } else {
            $allowedFolders = $user->permissions->pluck('folder_id')->toArray();

            if (!in_array($folder->id, $allowedFolders)) {
                $pathToRoot = [];
                $currentFolder = $folder;

                while ($currentFolder) {
                    $pathToRoot[] = $currentFolder->id;
                    $currentFolder = Folder::find($currentFolder->parent_id);
                }

                if (count(array_intersect($pathToRoot, $allowedFolders)) === 0) {
                    abort(403, 'No tienes permiso para acceder a esta carpeta.');
                }
            }
        }

        // Obtener las carpetas y archivos dentro de la carpeta actual
        $folders = Folder::where('parent_id', $folder->id)->get();
        $files = File::where('parent_id', $folder->id)->get();

        $fs = array();
        $nodoActual = Folder::find($folder->id);

        while ($nodoActual !== null) {

            array_push($fs, $nodoActual->name);;
            $nodoActual = Folder::find($nodoActual->parent_id);
        }

        $fs = array_reverse($fs);



        $currentFolderPath = '/' . join("/", $fs);

        return view('folder.show', compact('folders', 'folder', 'files', 'currentFolderPath'));
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

        $folderPath = $this->getFolderPath($folder);
        Storage::deleteDirectory($folderPath);

        $folder->delete();

        if ($parentFolderId !== null) {

            $folder = Folder::find($parentFolderId);

            return redirect()->route('folder.show', $folder);
        } else {
            return redirect()->route('folder.index');
        }
    }

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
