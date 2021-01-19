<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Speciality;
use App\Invoice;
use App\ClinicNote;
use Carbon\Carbon;

class AjaxController extends Controller
{
    public function user_speciality(Request $request){
        if($request->ajax()){
            $speciality = Speciality::findOrFail($request->speciality);
            $user = $speciality->users;
            return response()->json($user);
        }
    }
    public function invoice_info(Request $request){
        if($request->ajax()){
            $invoice = Invoice::findOrFail($request->invoice_id);
            // $invoice_meta = $invoice->metas;
            $doctor = $invoice->doctor('No aplica');
            $concept = $invoice->concept();
            return response()->json([
            'invoice' => $invoice, 
            'doctor' => $doctor,
            'concept' => $concept,
            ]);
        }
    }
    public function note_info(Request $request){
        if($request->ajax()){
            $note = ClinicNote::findOrFail($request->note_id);
            return response()->json([
                'route' => route('backoffice.clinic_note.update', [$note->user, $note]),
                'description' => $note->description,
                'privacy' => $note->privacy
            ]);
        }
    }

    public function disable_dates(Request $request)
    {
        if($request->ajax()){
            $user = \App\User::findOrFail($request->doctor);
            return response()->json([
                'disable_dates' => $user->manual_disabled_dates(),
                'days_off' => $user->days_off(),
            ]);
        }
    }

    public function disable_times(Request $request)
    {
        if($request->ajax()){
            // Detemrinar el usuario
            $user = \App\User::findOrFail($request->doctor);
            
            // Determinar el día que el usuario proceso
            $date = Carbon::parse($request->date);
            $day = $date->dayOfWeek + 1;

            //Arreglo de horarios base del doctor
            $hours = json_decode($user->hours(), true);

            //Econcontrar citas de un día en específico
            $date = $date;
            $appointments = $user->doctor_appointments()
                                ->whereDate('date', $date)
                                ->get()
                                ->pluck('date')
                                ->toJson();

            return response()->json([
                'hours' => $hours,
                'day' => $day,
                'date' => $date,
                'appointments' => $appointments
            ]);
        }
    }
}
