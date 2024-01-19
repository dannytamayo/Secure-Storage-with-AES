<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class FileController extends Controller
{
    public function destroy($id)
    {
        $file = File::find($id);

        if ($file) {
            $folder = Folder::find($file->parent_id);

            // Guarda el path del archivo antes de eliminarlo de la base de datos
            $filePath = $this->getFilePath($folder, $file->name);

            // Elimina el archivo de la base de datos
            $file->delete();

            // Elimina el archivo físicamente
            Storage::delete($filePath);

            // Redirige a la ruta deseada
            if ($folder) {
                return redirect()->route('folder.show', $folder);
            }

            return redirect()->route('folder.index');
        }
    }

    // Método auxiliar para obtener la ruta completa del archivo en el almacenamiento
    private function getFilePath(Folder $folder, $fileName)
    {
        $folders = [];

        while ($folder !== null) {
            array_push($folders, $folder->name);
            $folder = Folder::find($folder->parent_id);
        }

        return join('/', array_reverse($folders)) . '/' . $fileName;
    }

    public function download($id)
    {
        $file = File::find($id);


     
    if ($file) {
        $filePath = $this->getFilePathD($file);

        // Obtén la clave de cifrado desde la base de datos
        $encryptionKey = $file->encryption_key;

        // Descifra el contenido del archivo
        $decryptedContent = Crypt::decrypt(Storage::get($filePath), $encryptionKey);

        // Crea una respuesta con el contenido descifrado
        $response = response()->make($decryptedContent);

        // Establece el encabezado de la respuesta para la descarga
        $response->header('Content-Type', Storage::mimeType($filePath));
        $response->header('Content-Disposition', 'attachment; filename="' . $file->name . '"');

        return $response;
    }

    }

    // Método auxiliar para obtener la ruta relativa del archivo en el almacenamiento
    private function getFilePathD(File $file)
    {
        $folders = [];

        $currentFolder = Folder::find($file->parent_id);

        while ($currentFolder !== null) {
            array_push($folders, $currentFolder->name);
            $currentFolder = $currentFolder->parent;
        }

        return join('/', array_reverse($folders)) . '/' . $file->name;
    }
}
