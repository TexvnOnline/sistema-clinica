<?php

namespace App\Http\Controllers;

use App\ClinicNote;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ClinicNote\StoreRequest;

class ClinicNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, User $user, ClinicNote $clinic_note)
    {
        $clinic_note->store($request, $user);

        return redirect()->route('backoffice.clinic_data.index', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClinicNote  $clinicNote
     * @return \Illuminate\Http\Response
     */
    public function show(ClinicNote $clinicNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClinicNote  $clinicNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ClinicNote $clinicNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClinicNote  $clinicNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, ClinicNote $clinic_note)
    {
        $clinic_note->my_update($request);

        return redirect()->route('backoffice.clinic_data.index', $user);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClinicNote  $clinicNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClinicNote $clinicNote)
    {
        //
    }
}
