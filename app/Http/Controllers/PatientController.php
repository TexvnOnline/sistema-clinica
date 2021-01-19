<?php

namespace App\Http\Controllers;

use App\User;

use App\Appointment;
use App\Invoice;
use Carbon\Carbon;
use App\Speciality;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function schedule(){
        // $user = user();
        $user = user();
        $specialities =  Speciality::all();
        return view('frontoffice.patient.schedule', compact('user','specialities'));
    }

    public function back_schedule(User $user){
        $specialities =  Speciality::all();
        return view('admin.user.patient.schedule', compact('user','specialities'));
    }

    // VER SI SE PUEDEN UNIFICAR LOS METODOS DE store_schedule store_back_schedule
    public function store_schedule(Request $request, Appointment $appointment, Invoice $invoice){
        $invoice = $invoice->store($request);
        $appointment = $appointment->store($request, $invoice);
        return redirect()->route('frontoffice.patient.appointments');
    }

    public function store_back_schedule(Request $request, User $user, Appointment $appointment, Invoice $invoice){
        $invoice = $invoice->store($request);
        $appointment = $appointment->store($request, $invoice);
        return redirect()->route('backoffice.users.show', $user);
    }

    public function appointments(){
        $user = user();
        $appointments = user()->appointments->sortBy('date');
        return view('frontoffice.patient.appointments', compact('user','appointments'));
    }

    public function back_appointments(User $user){
        //administrador puede ver todas las citas de ese paciente
//VER SI FUNCIONA
        //un doctor solo pueder sus citas 
        if (user()->has_role(config('app.doctor_role'))) {
            $appointments = $user->appointments->where('doctor_id', user()->id)->sortBy('date');
        }else{
            $appointments = $user->appointments->sortBy('date');
        }
        return view('admin.user.patient.appointment', compact('user','appointments'));
    }

    //listar todas las citas del sistema
    public function show_appointments(){
        $appointments_collection = Appointment::all();
        $appointments = [];
        foreach ($appointments_collection as $key => $appointment) {
          
            $appointments[] = [
                'title' => $appointment->user->name.' Cita con '.$appointment->doctor()->name,
                'start' => $appointment->date->format('Y-m-d\TH:i:s'),
                'url' => route('backoffice.patient.appointments.edit', [$appointment->user, $appointment]),
            ];
        }
        return view('admin.appointment.show', [
            'appointments' => json_encode($appointments)
        ]);
    }

    //listar citas por doctor
    public function show_doctor_appointments(User $user){

        $this->authorize('view_appointments_calendar', $user);

        $appointments_collection = Appointment::where('doctor_id', $user->id)->get();
        $appointments = [];
        foreach ($appointments_collection as $key => $appointment) {
          
            $appointments[] = [
                'title' => $appointment->user->name.' Cita con '.$appointment->doctor()->name,
                'start' => $appointment->date->format('Y-m-d\TH:i:s'),
                'url' => route('backoffice.patient.appointments.edit', [$appointment->user, $appointment]),
            ];
        }
        return view('admin.appointment.show', [
            'user' => $user,
            'appointments' => json_encode($appointments)
        ]);
    }
    
    public function back_appointments_edit(User $user, Appointment $appointment){

        $this->authorize('edit_back_appointment', $appointment); 
        
        return view('admin.user.patient.appointment_edit', compact('user', 'appointment'));
    }
    //guardar actualizacion de citas
    public function back_appointments_update(Request $request, User $user, Appointment $appointment){
       
        $this->authorize('edit_back_appointment', $appointment); 

        $appointment->my_update($request);
        return redirect()->route('backoffice.users.show', $user);
    }

    public function prescriptions(){
        $user = user();
        return view('frontoffice.patient.prescriptions', compact('user'));
    }
    public function invoices(){
        $user = user();
        $invoices = user()->invoices;
        return view('frontoffice.patient.invoices', compact('user','invoices'));
    }
    public function back_invoices(User $user){

        if (user()->has_role(config('app.doctor_role'))) {
            $invoices = [];
            $user_invoices = $user->invoices;
            foreach ($user_invoices as $key => $invoice) {
                if($invoice->meta('doctor') == user()->id){
                    $invoices[] = $invoice;
                }
            }
            $invoices = collect($invoices);
        }else{
            $invoices = $user->invoices;
        }
        return view('admin.user.patient.invoice', compact('user', 'invoices'));
    }

    //EDITAR FACTURA DE PACIENTE POR SECRETARIO
    public function back_invoices_edit(User $user, Invoice $invoice){

        //autorizacion para doctores

        $this->authorize('edit_back_invoice', $invoice); 

        return view('admin.invoice.edit', compact('user', 'invoice'));
    }

    //SUBIR CAMBIOS DE EDICION
    public function back_invoices_update(Request $request, User $user, Invoice $invoice){

        //autorizacion para doctores

        $this->authorize('edit_back_invoice', $invoice); 

        
        $invoice->my_update($request);

        return redirect()->route('backoffice.users.show', $user);
    }

   
}
