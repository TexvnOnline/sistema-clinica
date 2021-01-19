<?php

namespace App;

use App\User;
use Carbon\Carbon;
use App\InvoiceMeta;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'date', 'doctor_id','status', 'user_id','invoice_id',
    ]; 
    protected $dates = ['date'];
    //RELACIONES 
    public function invoice(){
        return $this->belongsTo('App\Invoice');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    //ALMACENAMIENTO
    public function store($request, $invoice){
        $date = Carbon::createFromFormat('Y-m-d H:i', $request->date_submit . '' .$request->time_submit);
        InvoiceMeta::create([
            'key' => 'doctor', 
            'value' => $request->doctor, 
            'invoice_id' => $invoice->id
            ]);
        InvoiceMeta::create([
            'key' => 'concept', 
            'value' => 'Cita medica', 
            'invoice_id' => $invoice->id
            ]);  

        return self::create([
            'date' => $date->toDateTimeString(),
            'doctor_id' => $request->doctor,
            'status'=> 'pending',
            'user_id'=> $invoice->user->id,
            'invoice_id' => $invoice->id
        ]);
    } 

    //ACTUALIZAR CITAS
    public function my_update($request){
        $date = Carbon::createFromFormat('Y-m-d H:i', $request->date_submit . '' .$request->time_submit);
       
        $invoice_status = ($request->status == 'done') ? 'approved' : $request->status ;
   

        self::update([
            'date' => $date->toDateTimeString(),
            'status' => $request->status
        ]);

        $this->invoice->update([
            'status' => $invoice_status
        ]);
    }

    //RECUPERAR INFORMACION
    public function doctor(){
        $doctor = User::find($this->doctor_id);
        return $doctor;
    }
}
