<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Barangay_controller extends Controller
{
    public function proceeding(Request $request)
    {
        $validated = $request->validate([
            'region' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
        ]);

        return view('proceeding')
            ->with('region',$request->input('region'))
            ->with('province',$request->input('province'))
            ->with('city',$request->input('city'))
            ->with('barangay',$request->input('barangay'));
    }

    public function proceeding_register(Request $request)
    {
        $validated = $request->validate([
            'invitation_code' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'user_image' => 'required',
        ]);
    }
}
