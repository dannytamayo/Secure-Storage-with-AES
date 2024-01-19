<?php

namespace App\Http\Middleware;

use App\Models\FolderPermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckFolderPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $folderId = null;

        // Verificar si el parámetro 'id' está presente en la ruta
        if ($request->route('id')) {
            $folderId = $request->route('id');
        }
        // Verificar si el parámetro 'id' está presente en la query string (por ejemplo, en folder/upload?id=1)
        elseif ($request->query('id')) {
            $folderId = $request->query('id');
        }
    
        // Verifica si el usuario tiene permisos para acceder a la carpeta
        if ($folderId !== null && $this->userHasPermission($folderId)) {
            return $next($request);
        }
    
        // Puedes personalizar la respuesta en caso de que no tenga permisos
        return response()->json(['error' => 'No tienes permisos para acceder a esta carpeta.'], 403);
    }

    private function userHasPermission($folderId)
    {
        // Obtiene el usuario autenticado
        $user = Auth::user();

        // Verifica si el usuario tiene permisos para la carpeta
        return FolderPermission::where('user_id', $user->id)
            ->where('folder_id', $folderId)
            ->exists();
    }
}
