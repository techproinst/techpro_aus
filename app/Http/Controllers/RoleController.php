<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

   public function __construct()
   {  
    /*
      
    $this->middleware('permission:view role',['only' => ['index', 'edit']]);
    $this->middleware('permission:create role',['only' => ['create', 'store', 'addPermissionToRole', 'givePermissionToRole']]);
      $this->middleware('permission:update role',['only' => ['update', 'edit']]);
      $this->middleware('permission:delete role',['only' => ['destroy']]);

      */
   }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
    
        return view('admin.roles.view', compact('roles'));
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
            'name' => ['required','string', 'unique:roles,name']

        ]);

        Role::create([
            'name' => $request->name,
        ]);


        return redirect()->back()->with([
            'flash_message' => 'Role created successfully',
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
    public function update(Request $request, Role $role)
    {

        $request->validate([
            'name' => ['required','string', 'unique:roles,name,'.$role->id]

        ]);

        $role->update([
            'name' => $request->name,
        ]);


        return redirect()->back()->with([
            'flash_message' => 'Role updated successfully',
            'flash_type' => 'success',

        ]);




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roleId)
    {
      $role = Role::find($roleId);

      $role->delete();

      return redirect()->back()->with([
        'flash_message' => 'Role deleted successfully',
        'flash_type' => 'success',

    ]);

    }

    public function addPermissionToRole($roleId)
    {   
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $role->id)->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();

        return view('admin.roles.add-permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    public function  givePermissionToRole(Request $request,$roleId)
    {
        $request->validate([
            'permission' => 'required',

        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        
      return redirect()->back()->with([
        'flash_message' => 'Permissions added to Role  successfully',
        'flash_type' => 'success',

    ]);
    }


















}
