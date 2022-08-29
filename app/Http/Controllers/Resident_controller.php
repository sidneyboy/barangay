<?php

namespace App\Http\Controllers;

use App\Models\Residents;
use App\Models\Assistance_type;
use App\Models\Assitance;
use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        //dd($request->all());
        $user_image = $request->file('image');
        $image_name = 'image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $image_name);

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
            'image' => $image_name,
        ]);

        $assistance->save();

        return redirect()->route('res_assistance', ['resident_id' => $request->input('resident_id')])->with('success', 'Successfully submitted new request.');
    }

    public function res_assistance_request($resident_id)
    {
        $resident = Residents::find($resident_id);
        $assistance = Assitance::orderBy('id', 'desc')->get();
        return view('res_assistance_request', [
            'resident' => $resident,
            'assistance' => $assistance,
        ]);
    }

    public function resident_profile($resident_id)
    {
        $resident = Residents::find($resident_id);
        $assistance = Assitance::orderBy('id', 'desc')->get();
        return view('resident_profile', [
            'resident' => $resident,
            'assistance' => $assistance,
        ]);
    }

    public function resident_profile_update(Request $request)
    {

        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Residents::where('id', $request->input('resident_id'))
            ->update([
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'gender' => $request->input('gender'),
                'civil_status' => $request->input('civil_status'),
                'birth_date' => $request->input('birth_date'),
                'email' => $request->input('email'),
                'contact_number' => $request->input('contact_number'),
                'password' => Hash::make($request->input('password')),
                'spouse' => $request->input('spouse'),
            ]);

        return redirect()->route('resident_profile', ['resident_id' => $request->input('resident_id')])->with('success', 'Successfully updated your profile');
    }

    public function resident_profile_image_update(Request $request)
    {
        $validated = $request->validate([
            'user_image' => ['required'],
        ]);

        $user_image = $request->file('user_image');
        $image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $image_name);

        Residents::where('id', $request->input('resident_id'))
            ->update([
                'user_image' => $image_name,
            ]);

        return redirect()->route('resident_profile', ['resident_id' => $request->input('resident_id')])->with('success', 'Successfully updated your profile');
    }

    public function resident_complain($resident_id)
    {
        $resident = Residents::find($resident_id);
        $assistance = Assitance::orderBy('id', 'desc')->get();
        $respondent = Residents::where('id', '!=', $resident_id)->get();
        return view('resident_complain', [
            'resident' => $resident,
            'assistance' => $assistance,
            'respondent' => $respondent,
        ]);
    }

    public function resident_complain_process(Request $request)
    {
        //return $request->input();
        $new = new Complain([
            'complainant_id' => $request->input('resident_id'),
            'respondent_id' => $request->input('respondent_id'),
            'reason' => $request->input('reason'),
            'barangay_id' => $request->input('barangay_id'),
            'status' => 'Pending Approval',
        ]);

        $new->save();

        return redirect()->route('resident_complain', ['resident_id' => $request->input('resident_id')])->with('success', 'Successfully submitted complain request, Please wait for an email indicating the approval and schedule of hearing.');
    }

    public function resident_complain_request($resident_id)
    {
        $resident = Residents::find($resident_id);
        $assistance = Assitance::orderBy('id', 'desc')->get();
        $complain = Complain::orderBy('id','desc')->get();
        return view('resident_complain_request', [
            'resident' => $resident,
            'assistance' => $assistance,
            'complain' => $complain,
        ]);
    }
}
