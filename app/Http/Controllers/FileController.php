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

            $filePath = $this->getFilePath($folder, $file->name);

            $file->delete();

            Storage::delete($filePath);

            if ($folder) {
                return redirect()->route('folder.show', $folder);
            }

            return redirect()->route('folder.index');
        }
    }

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

        $encryptionKey = $file->encryption_key;

        $decryptedContent = Crypt::decrypt(Storage::get($filePath), $encryptionKey);

        $response = response()->make($decryptedContent);

        $response->header('Content-Type', Storage::mimeType($filePath));
        $response->header('Content-Disposition', 'attachment; filename="' . $file->name . '"');

        return $response;
    }

    }

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
