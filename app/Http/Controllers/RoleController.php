<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function __construct()
    {
    $this->middleware('role:' . config('app.admin_role'));
    }
    public function index()
    {
        $this->authorize('index',Role::class);
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('admin.role.index', compact('roles'));
    }
    public function create()
    {
        $this->authorize('create', Role::class);
        return view('admin.role.create');
    }
    public function store(StoreRequest $request, Role $role )
    {
        $role = $role->store($request);
        return redirect()->route('backoffice.roles.index')->with('guardado','ok');
    }
    public function show(Role $role)
    {
        $this->authorize('view',$role);
        return view('admin.role.show', compact('role'));
    }
    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        return view('admin.role.edit', compact('role'));
    }
    public function update(UpdateRequest $request, Role $role)
    {
        $role->my_update($request);
        return redirect()->route('backoffice.roles.index')->with('editado','ok');
        // return redirect()->route('backoffice.roles.show', $role);
    }
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);
        $role->delete();
        return  redirect()->back()->with('eliminar','ok');
    }
}
