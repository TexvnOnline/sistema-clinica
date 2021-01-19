<?php

namespace App\Http\Controllers;

use App\Speciality;
use Illuminate\Http\Request;
use App\Http\Requests\Speciality\StoreRequest;
use App\Http\Requests\Speciality\UpdateRequest;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialities = Speciality::orderBy('id','DESC')->paginate(5);
        return view('admin.speciality.index', compact('specialities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.speciality.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Speciality $speciality)
    {
        $speciality = $speciality->store($request);
        return redirect()->route('backoffice.speciality.show', $speciality);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function show(Speciality $speciality)
    {
        $users = $speciality->users;
        return view('admin.speciality.show', compact('speciality','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function edit(Speciality $speciality)
    {
        return view('admin.speciality.edit', compact('speciality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Speciality $speciality)
    {
        $speciality->my_update($request);
        return redirect()->route('backoffice.speciality.show', $speciality);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speciality $speciality)
    {
        $speciality->delete();
        return redirect()->route('backoffice.speciality.index');
    }
}
