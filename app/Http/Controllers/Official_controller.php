<?php

namespace App\Http\Controllers;

use App\Models\Barangay_officials;
use App\Models\Residents;
use App\Models\Assistance_type;
use App\Models\Assitance;
use App\Mail\send_email_to_resident;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Official_controller extends Controller
{
    public function official_login_process(Request $request)
    {
        $user = Barangay_officials::where('email', $request->input('email'))->first();
        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                return redirect()->route('official_welcome', ['user_id' => $user->id]);
            } else {
                return redirect('/')->with('error', 'Wrong Credentials');
            }
        } else {
            $resident = Residents::where('email', $request->input('email'))->first();
            if ($resident) {
                if (Hash::check($request->input('password'), $resident->password)) {
                    return redirect()->route('resident_welcome', ['resident_id' => $resident->id]);
                } else {
                    return redirect('/')->with('error', 'Wrong Credentials');
                }
            }
        }
    }

    public function official_welcome($user_id)
    {
        $user = Barangay_officials::find($user_id);

        return view('official_welcome', [
            'user' => $user,
        ]);
    }

    public function official_assistance_type($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $type = Assistance_type::where('barangay_id', $user->barangay_id)->get();
        return view('official_assistance_type', [
            'user' => $user,
            'type' => $type,
        ]);
    }

    public function official_assistance_type_process(Request $request)
    {
        $new = new Assistance_type([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $request->input('user_id'),
            'barangay_id' => $request->input('barangay_id'),
        ]);

        $new->save();

        return redirect()->route('official_assistance_type', ['user_id' => $request->input('user_id')])->with('success', 'Successfully added new assistance type');
    }

    public function official_res_registration($user_id)
    {
        $user = Barangay_officials::find($user_id);
        return view('official_res_registration', [
            'user' => $user,
        ]);
    }

    public function official_res_registration_process(Request $request)
    {


        $validated = $request->validate([
            'user_image' => 'required',
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => 'required|not_in:0',
            'civil_status' => 'required|not_in:0',
            'birth_date' => 'required',
            'mothers_name' => 'required',
            'fathers_name' => 'required',
            'contact_number' => ['required', 'numeric', 'min:11'],
            'spouse' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:residents'],
        ]);

        $user_image = $request->file('user_image');
        $image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $image_name);

        $user = Barangay_officials::find($request->input('user_id'));

        $password = uniqid();

        $officials = new Residents([
            'user_image' => $image_name,
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'civil_status' => $request->input('civil_status'),
            'birth_date' => $request->input('birth_date'),
            'mothers_name' => $request->input('mothers_name'),
            'fathers_name' => $request->input('fathers_name'),
            'contact_number' => $request->input('contact_number'),
            'spouse' => $request->input('spouse'),
            'email' => $request->input('email'),
            'password' => hash::make($password),
            'user_id' => $user->id,
            'barangay_id' => $user->barangay_id,
        ]);

        $officials->save();

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        Mail::to('salazarjohnsidney@gmail.com')->send(new send_email_to_resident($email, $password, $first_name, $last_name));

        return redirect()->route('official_res_registration', ['user_id' => $request->input('user_id')])->with('success', 'Successfully added new resident');
    }

    public function official_res_profile($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $resident = Residents::get();
        return view('official_res_profile', [
            'resident' => $resident,
            'user' => $user
        ]);
    }

    public function official_res_profile_update(Request $request)
    {
        //return $request->input();

        Residents::where('id', $request->input('resident_id'))
            ->update([
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'gender' => $request->input('gender'),
                'civil_status' => $request->input('civil_status'),
                'birth_date' => $request->input('birth_date'),
                'mothers_name' => $request->input('mothers_name'),
                'fathers_name' => $request->input('fathers_name'),
                'contact_number' => $request->input('contact_number'),
                'spouse' => $request->input('spouse'),
            ]);

        return redirect()->route('official_res_profile', ['user_id' => $request->input('user_id')])->with('success', 'Successfully updated resident profile');
    }

    public function official_logout()
    {
        return redirect('/');
    }

    public function official_assistance_request($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $assistance = Assitance::orderBy('id', 'desc')->where('barangay_id', $user->barangay_id)->get();
        return view('official_assistance_request', [
            'user' => $user,
            'assistance' => $assistance,
        ]);
    }

    public function official_assistance_approved(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        Assitance::where('id', $request->input('assistance_id'))
            ->update([
                'approved_cash' => $request->input('approved_cash'),
                'approved_by_official_id' => $request->input('approved_by_official_id'),
                'approved_date' => $date,
                'status' => 'approved',
            ]);

        return redirect()->route('official_assistance_request', ['user_id' => $request->input('approved_by_official_id')])->with('success', 'Successfully approved request cash assistance');
    }
}
