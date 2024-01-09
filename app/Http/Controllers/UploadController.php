<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index($id)
    {

        $folder = Folder::find($id); // Asegúrate de que tu modelo Folder tenga el método 'find'

        return view('upload.show', compact('folder'));
    }

    public function upload(Request $request)
    {

        // dd($request->files);

        $request->validate([
            'files.*' => 'mimes:pdf,doc|max:10240', // Ajusta los tipos de archivos permitidos y el tamaño máximo según tus necesidades.
        ]);

        $parent_id = $request->parent;

        $nodoActual = Folder::find($parent_id);

        $folders = [];


        while ($nodoActual != null) {
            array_push($folders, $nodoActual->name);;
            $nodoActual = Folder::find($nodoActual->parent_id);
        }

        $folders = array_reverse($folders);

        $folderPath = join("/", $folders);

        foreach ($request->file('files') as $file) {
            Storage::put($folderPath, $file);
        }

        return redirect()->back();
    }
}
