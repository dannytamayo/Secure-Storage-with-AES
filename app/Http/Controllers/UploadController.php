<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function index($id)
    {

        $folder = Folder::find($id); 

        return view('upload.show', compact('folder'));
    }

    public function upload(Request $request)
    {

        // dd($request->file('files'));

        $request->validate([
            'parent' => 'required',
            'files' => 'required',
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
            $nombreOriginal = $file->getClientOriginalName();

            $encryptionKey = Str::random(32); 

            // Cifra el contenido del archivo
            $encryptedContent = Crypt::encrypt(file_get_contents($file), $encryptionKey);

            $fileSave = Storage::put($folderPath . '/' . $nombreOriginal, $encryptedContent);

            $fileModel = new File([
                'name' => $nombreOriginal,
                'path' => $folderPath,
                'parent_id' => $parent_id,
                'encryption_key' => $encryptionKey,
            ]);

            $fileModel->save();
        }

        $folder = Folder::find($parent_id); 

        return redirect()->route('folder.show', compact('folder'));
    }
}
