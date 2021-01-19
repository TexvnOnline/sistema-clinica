<?php

namespace App\Http\Controllers;

use App\ClinicData;
use App\User;
use Illuminate\Http\Request;

class ClinicDataController extends Controller
{
    public function index(User $user)
    {
        $datas = $user->clinic_data_array();
        $clinic_notes = $user->clinic_notes->sortByDesc('created_at');
        return view('admin.user.patient.clinicdata.index', compact('user','datas','clinic_notes'));
    }
    public function create(User $user)
    {
        $datas = $user->clinic_data_array();
        return view('admin.user.patient.clinicdata.form', compact('user','datas'));
    }
    public function store(Request $request, User $user, ClinicData $clinic_data)
    {
        $clinic_data->store($request, $user);

        return redirect()->route('backoffice.clinic_data.index', $user);
    }

}
