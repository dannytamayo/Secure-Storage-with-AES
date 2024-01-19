<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\FolderPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        $user = User::find($id);

        
        $folders = Folder::with('children')->whereNull('parent_id')->get();
        $folderOptions = $this->buildFolderOptions($folders);
        // dd($user);

        return view('admin.users.edit', compact('user', 'folderOptions'));
    }

    /**
     * Update the specified resource in storage.
     * 
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $folderId = $request->folderId;

        $permission = FolderPermission::create([
            'user_id' => $user->id,
            'folder_id' => $folderId
        ]);

        if ($permission) {
            return redirect()->route('rol.index');
        }
        // $user->roles()->sync($request->roles);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }

    private function buildFolderOptions($folders, $prefix = '') {
        $html = '';
        foreach ($folders as $folder) {
            $html .= '<option value="' . $folder->id . '">' . $prefix . $folder->name . '</option>';
            if ($folder->children) {
                $html .= $this->buildFolderOptions($folder->children, $prefix . '--');
            }
        }
        return $html;
    }
}
