<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:' . config('app.admin_role'));
    }
    public function index()
    {
        $this->authorize('index',Role::class);
        $permissions = Permission::orderBy('id','DESC')->paginate(5);
        return view('admin.permission.index', compact('permissions'));
    }
    public function create()
    {
        $this->authorize('create',Role::class);
        $roles = Role::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.permission.create',compact('roles'));
    }
    public function store(StoreRequest $request, Permission $permission)
    {
        $permission = $permission->store($request);
        return redirect()->route('backoffice.permissions.index')->with('guardado','ok');
    }
    public function show(Permission $permission)
    {
        $this->authorize('view', $permission);
        return view('admin.permission.show', compact('permission'));
    }
    public function edit(Permission $permission)
    {
        $this->authorize('update', $permission);
        $roles = Role::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.permission.edit', compact('permission','roles'));
    }
    public function update(UpdateRequest $request, Permission $permission)
    {
        $permission->my_update($request);
        return redirect()->route('backoffice.permissions.index')->with('editado','ok');
    }
    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission);
        // $role = $permission->role;
        $permission->delete();
        return  redirect()->back()->with('eliminar','ok');
    }
}
