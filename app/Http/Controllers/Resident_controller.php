<?php

namespace App\Http\Controllers;

use App\Models\Residents;
use App\Models\Assistance_type;
use App\Models\Assitance;
use Illuminate\Http\Request;

class Resident_controller extends Controller
{
    public function resident_welcome($resident_id)
    {
        $resident = Residents::find($resident_id);
        return view('resident_welcome', [
            'resident' => $resident,
        ]);
    }

    public function res_assistance($resident_id)
    {
       
        $resident = Residents::find($resident_id);
        $assistance_type = Assistance_type::get();
        return view('res_assistance', [
            'resident' => $resident,
            'assistance_type' => $assistance_type,
        ]);
    }

    public function res_assistance_process(Request $request)
    {
        $validated = $request->validate([
            'assistance_type_id' => 'required',
            'explanation' => 'required',
        ]);
        $assistance = new Assitance([
            'assistance_type_id' => $request->input('assistance_type_id'),
            'resident_id' => $request->input('resident_id'),
            'barangay_id' => $request->input('barangay_id'),
            'explanation' => $request->input('explanation'),
            'status' => 'New Request',
        ]);

        $assistance->save();

        return redirect()->route('res_assistance', ['resident_id' => $request->input('resident_id')])->with('success', 'Successfully submitted new request.');
    }

    public function res_assistance_request($resident_id)
    {
        $resident = Residents::find($resident_id);
        $assistance = Assitance::orderBy('id','desc')->get();
        return view('res_assistance_request', [
            'resident' => $resident,
            'assistance' => $assistance,
        ]);
    }
}
