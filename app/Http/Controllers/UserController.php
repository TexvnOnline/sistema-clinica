<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Role;
use App\Speciality;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('index', User::class);

        // MOSTRAR LOS USUARIOS DEPENDIENDO DEL ROL
        // $users = User::orderBy('id','DESC')->paginate(10);
        // ==============
        $users = auth()->user()->visible_users();

        return view('admin.user.index', compact('users'));
    }
    public function create()
    {
        $this->authorize('create', User::class);

        $roles = auth()->user()->visible_roles();
        // $roles = Role::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.user.create', compact('roles'));
    }
    public function store(StoreRequest $request, User $user)
    {
        $user = $user->store($request);
        return  redirect()->route('backoffice.users.index')->with('guardado','ok');
    }
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('admin.user.show', compact('user'));
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $view = (isset($_GET['view'])) ? $_GET['view'] : null;
        $roles = Role::orderBy('name', 'ASC')->pluck('name', 'id');
        return view($user->edit_view($view), compact('user','roles'));
    }
    public function update(UpdateRequest $request, User $user)
    {
        $user->my_update($request);
        
        $view = (isset($_GET['view'])) ? $_GET['view'] : null;
        return  redirect()->route($user->user_show(),$user)->with('editado','ok');

    }
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return  redirect()->route('backoffice.users.index')->with('eliminar','ok');
    }





    // Mostrar formulario para adignar role
    public function assign_role(User $user)
    {
        $this->authorize('assign_role', $user);
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('admin.user.assign_role', compact('roles','user'));
    }
    // Asignar los roles en la base de datos
    public function role_assignment(Request $request, User $user)
    {
        $this->authorize('assign_role', $user);
        $user->role_assignment($request);
        return  redirect()->route('backoffice.users.show',$user)->with('guardado','ok');
    }
      // Mostrar formulario para adignar permissos
      public function assign_permission(User $user)
      {
        $this->authorize('assign_permission', $user);
        $roles = $user->roles;
        return view('admin.user.assign_permission', compact('user','roles'));
      }
      // Asignar los permissos en la base de datos
      public function permission_assignment(Request $request, User $user)
      {
        $this->authorize('assign_permission', $user);
        $user->permissions()->sync($request->permissions);
        return  redirect()->route('backoffice.users.show',$user)->with('guardado','ok');
      }

     //FORMULARIO PARA ASIGNAR ESPECIALIDADES 
     public function assign_speciality(User $user){

        // $this->authorize('assign_permission', $user);
        $specialities = Speciality::all();
        return view('admin.user.assign_speciality', compact('user','specialities'));

     }
     //GUARDAR ESPECIALIDADES
     public function speciality_assignment(Request $request, User $user){
        $user->specialities()->sync($request->specialities);
        return redirect()->route('backoffice.users.show', $user);
     }

       // FORMULARIO PARA IMPORTAR USUARIOS
    public function import() 
    {
        $this->authorize('import', $user);
        return view('admin.user.import');
    }
    // Importar datos
    public function make_import(Request $request) 
    {
        $this->authorize('import', $user);

        $file = $request->file('file');

        Excel::import(new UsersImport, $file);
        // incluir mensaje de exito
        return redirect()->route('backoffice.users.index');
    }

    public function profile(){
        $user = auth()->user();
        return view('frontoffice.user.profile', compact('user'));
    }
    public function edit_password(){
        $user = auth()->user();
        $this->authorize('update_password', auth()->user());
        return view('frontoffice.user.edit_password', compact('user'));
    }
    public function change_password(ChangePasswordRequest $request){
        
        $request->user()->password = Hash::make($request->password);
        $request->user()->save();
        return redirect()->back()->with('guardado','ok');
    }
}
