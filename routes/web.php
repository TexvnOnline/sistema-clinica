<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/admin', function () {
    return view('admin.role.create');
});

Auth::routes();



route::group(['middleware'=>['auth'], 'as'=>'backoffice.'], function(){

    
    Route::get('admin', 'AdminController@show')->name('admin.show');

    Route::resource('users', 'UserController')->names('users');

    Route::get('users_import', 'UserController@import')->name('users.import');
    Route::post('users_make_import', 'UserController@make_import')->name('users.make_import');
    Route::get('users/{user}/asignar_roles', 'UserController@assign_role')->name('assign_role');
    Route::post('users/{user}/role_assignment', 'UserController@role_assignment')->name('role_assignment');
    Route::get('user/{user}/asignar_permission', 'UserController@assign_permission')->name('assign_permission');
    Route::post('user/{user}/permission_assignment', 'UserController@permission_assignment')->name('permission_assignment');

    Route::get('patient/{user}/schedule','PatientController@back_schedule')->name('patient.schedule');
    
    // EDITAR CITAS
    Route::get('patient/{user}/appointments/{appointment}/edit','PatientController@back_appointments_edit')->name('patient.appointments.edit');
    //GUARDAR CITAS EDITADAS
    Route::put('patient/{user}/appointments/{appointment}/update','PatientController@back_appointments_update')->name('patient.appointments.update');
    //========
    Route::post('patient/{user}/store_back_schedule', 'PatientController@store_back_schedule')->name('patient.store_back_schedule');
    
    //CITAS DE PACIENTE EN BACK OFFICE
    Route::get('patient/{user}/appointments','PatientController@back_appointments')->name('patient.appointments');
    //FACTURACION PARA PACIENTES
    Route::get('patient/{user}/invoices','PatientController@back_invoices')->name('patient.invoices');
    //EDITAR FACTURA DE PACIENTE POR SECRETARIO
    Route::get('patient/{user}/invoices/{invoice}/edit','PatientController@back_invoices_edit')->name('patient.invoices.edit');
    //EDITAR SUBIR CAMBIOS DE EDICION UPDATE
    Route::put('patient/{user}/invoices/{invoice}/update','PatientController@back_invoices_update')->name('patient.invoices.update');

    //LISTAR TODAS LAS CITAS REGISTRADAS EN EL SISTEMA 
    Route::get('backoffice/appointments','PatientController@show_appointments')->name('patient.appointments.show');

    //LISTAR CITAS POR DOCTOR
    Route::get('backoffice/doctor/{user}/appointments','PatientController@show_doctor_appointments')->name('doctor.appointments.show');


    Route::resource('roles', 'RoleController')->names('roles');
    Route::resource('permission', 'PermissionController')->names('permissions');

    
    Route::resource('speciality', 'SpecialityController');
    
    Route::get('users/{user}/assign_speciality', 'UserController@assign_speciality')->name('user.assign_speciality');
    
    Route::post('users/{user}/speciality_assignment', 'UserController@speciality_assignment')->name('user.speciality_assignment');
  
    //RUTA PARA HISTORIAS CLINICAS 
    // El método index retornará la vista de la historia clínica del usuario
    // El método create nos muestra un formulario para editar los datos de la historia clínica.
    // El método store actualiza la información enviada por el formulario.
    Route::resource('patient/{user}/clinic_data', 'ClinicDataController')->only([
        'index', 'create', 'store'
    ]);

    
    Route::resource('patient/{user}/clinic_note', 'ClinicNoteController')->only([
        'store', 'edit', 'update', 'destroy'
    ]);
    
    // RUTAS PARA DESABILITAR LOS HORARIOS DE LOS DOCTORES PARA CITAS

    // La perimer ruta retorna la vista con el formulario para determinar los días laborales y no laborales.
    // La segunda ruta se encarga de procesar la petición del usuario y almacenar la información en la base de datos.
    Route::get('doctor/{user}/doctor_schedule', 'DoctorScheduleController@assign')->name('doctor.schedule.assign');
    Route::post('doctor/{user}/doctor_schedule', 'DoctorScheduleController@assignment')->name('doctor.schedule.assignment');

});


Route::group(['as'=>'frontoffice.'], function() {
    
    Route::get('profile','UserController@profile')->name('user.profile');
    Route::get('profile/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::put('profile/{user}/update', 'UserController@update')->name('user.update');

    Route::get('profile/edit_password', 'UserController@edit_password')->name('user.edit_password');
    
    Route::put('profile/change_password', 'UserController@change_password')->name('user.change_password');
    


    Route::get('paciente/schedule','PatientController@schedule')->name('patient.schedule');
    
    Route::post('paciente/store_schedule','PatientController@store_schedule')->name('patient.store_schedule');
    

    Route::get('paciente/appointments', 'PatientController@appointments')->name('patient.appointments');

    Route::get('paciente/prescriptions', 'PatientController@prescriptions')->name('patient.prescriptions');
    
    Route::get('paciente/invoices','PatientController@invoices')->name('patient.invoices');
    

    
});


Route::group(['middleware'=>['auth'],'as' => 'ajax.'], function() {

    
    Route::get('user_speciality', 'AjaxController@user_speciality')->name('user_speciality');
    
    Route::get('invoice_info', 'AjaxController@invoice_info')->name('invoice_info');
    
    Route::get('note_info', 'AjaxController@note_info')->name('note_info');

    Route::get('doctor/disable_dates', 'AjaxController@disable_dates')->name('doctor.disable_dates');

    Route::get('doctor/disable_times', 'AjaxController@disable_times')->name('doctor.disable_times');
});


