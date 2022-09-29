<?php

namespace App\Http\Controllers;

use App\Models\Residents;
use App\Models\Assistance_type;
use App\Models\Assitance;
use App\Models\Complain;
use App\Models\Document_type;
use App\Models\Document_request;
use App\Models\Barangay_logo;

use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Resident_controller extends Controller
{
    public function resident_welcome($resident_id)
    {
        $resident = Residents::find($resident_id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $resident->barangay_id)->first();
        return view('resident_welcome', [
            'resident' => $resident,
            'barangay_logo' => $barangay_logo,
        ]);
    }

    public function res_assistance($resident_id)
    {

        $resident = Residents::find($resident_id);
        $assistance = Assitance::where('resident_id',$resident_id)->where('status','New Request')->where('barangay_id',$resident->barangay_id)->get();
        $assistance_type = Assistance_type::where()->where('barangay_id',$resident->barangay_id)->get();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $resident->barangay_id)->first();
        return view('res_assistance', [
            'resident' => $resident,
            'assistance_type' => $assistance_type,
            'barangay_logo' => $barangay_logo,
            'assistance' => $assistance,
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


        $check = Assitance::where('barangay_id',$request->input('barangay_id'))->latest()->first();

        if ($check) {
            $assistance_number = $check->assistance_number + 1;
        }else{
            $assistance_number = 1;
        }

        $assistance = new Assitance([
            'assistance_type_id' => $request->input('assistance_type_id'),
            'resident_id' => $request->input('resident_id'),
            'barangay_id' => $request->input('barangay_id'),
            'explanation' => $request->input('explanation'),
            'status' => 'New Request',
            'image' => $image_name,
            'assistance_number' => $assistance_number,
        ]);

        $assistance->save();

        return redirect()->route('res_assistance', ['resident_id' => $request->input('resident_id')])->with('success', 'Successfully submitted new request.');
    }

    public function res_assistance_request($resident_id)
    {
        $resident = Residents::find($resident_id);
        $assistance = Assitance::orderBy('id', 'desc')->where('barangay_id',$resident->barangay_id)->get();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $resident->barangay_id)->first();
        return view('res_assistance_request', [
            'resident' => $resident,
            'assistance' => $assistance,
            'barangay_logo' => $barangay_logo,
        ]);
    }

    public function resident_profile($resident_id)
    {
        $resident = Residents::find($resident_id);
        $assistance = Assitance::orderBy('id', 'desc')->where('barangay_id',$resident->barangay_id)->get();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $resident->barangay_id)->first();
        return view('resident_profile', [
            'resident' => $resident,
            'assistance' => $assistance,
            'barangay_logo' => $barangay_logo,
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
        $assistance = Assitance::orderBy('id', 'desc')->where('barangay_id',$resident->barangay_id)->get();
        $respondent = Residents::where('id', '!=', $resident_id)->get();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $resident->barangay_id)->first();
        return view('resident_complain', [
            'resident' => $resident,
            'assistance' => $assistance,
            'respondent' => $respondent,
            'barangay_logo' => $barangay_logo,
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
        $assistance = Assitance::orderBy('id', 'desc')->where('barangay_id',$resident->barangay_id)->get();
        $complain = Complain::where('complainant_id',$resident_id)->orderBy('id', 'desc')->get();
        $respondent = Complain::where('respondent_id',$resident_id)->orderBy('id', 'desc')->get();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $resident->barangay_id)->first();
        return view('resident_complain_request', [
            'resident' => $resident,
            'assistance' => $assistance,
            'complain' => $complain,
            'respondent' => $respondent,
            'barangay_logo' => $barangay_logo,
        ]);
    }



    public function resident_document_request($resident_id)
    {
        $resident = Residents::find($resident_id);

        $complain_count = Complain::where('status', '!=', 'end')->where('respondent_id', $resident_id)->count();

        $document = Document_type::where('barangay_id', $resident->barangay_id)->get();
        $document_request = Document_request::where('resident_id', $resident_id)->get();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $resident->barangay_id)->first();
        return view('resident_document_request', [
            'resident' => $resident,
            'document' => $document,
            'document_request' => $document_request,
            'complain_count' => $complain_count,
            'barangay_logo' => $barangay_logo,
        ]);
    }

    public function resident_document_request_process(Request $request)
    {
        //return $request->input();

        $new = new Document_request([
            'resident_id' => $request->input('resident_id'),
            'document_type_id' => $request->input('document_type_id'),
            'barangay_id' => $request->input('barangay_id'),
            'reason' => $request->input('reason'),
            'status' => 'New Request',
        ]);

        $new->save();

        return redirect()->route('resident_document_request', ['resident_id' => $request->input('resident_id')])->with('success', 'Successfully requested new document');
    }
}
