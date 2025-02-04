<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{


    public function __construct()
    {
        
            $this->middleware('permission:view permission',['only' => ['index', 'edit']]);
            $this->middleware('permission:create permission',['only' => ['create', 'store',]]);
            $this->middleware('permission:update permission',['only' => ['update', 'edit']]);
            $this->middleware('permission:delete permission',['only' => ['destroy']]);
       
    
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::get();
        return view('admin.permissions.view', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string', 'unique:permissions,name']

        ]);

        Permission::create([
            'name' => $request->name,
        ]);


        return redirect()->back()->with([
            'flash_message' => 'Permission created successfully',
            'flash_type' => 'success',

        ]);







    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {

        $request->validate([
            'name' => ['required','string', 'unique:permissions,name,'.$permission->id]

        ]);

        $permission->update([
            'name' => $request->name,
        ]);


        return redirect()->back()->with([
            'flash_message' => 'Permission updated successfully',
            'flash_type' => 'success',

        ]);




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($permissionId)
    {
      $permission = Permission::find($permissionId);

      $permission->delete();

      return redirect()->back()->with([
        'flash_message' => 'Permission deleted successfully',
        'flash_type' => 'success',

    ]);

    }
}
