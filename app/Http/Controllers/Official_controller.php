<?php

namespace App\Http\Controllers;

use App\Models\Barangay_officials;
use App\Models\Residents;
use App\Models\Assistance_type;
use App\Models\Assitance;
use App\Models\Complain;
use App\Models\User;
use App\Models\Document_request;
use App\Models\Document_type;
use App\Models\Barangay_logo;

use App\Mail\send_email_to_resident;
use App\Mail\Assistance_approved_email;
use App\Mail\Disapproved;
use App\Mail\Document_approved_request;
use App\Mail\Document_received;




use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Official_controller extends Controller
{
    public function official_login_process(Request $request)
    {

        $user = Barangay_officials::where('email', $request->input('email'))->first();
        $barangay_staff = $request->input('barangay_staff');

        //return $request->input();
        if ($user) {
            if ($user->position->title == 'Lupon') {
                if (Hash::check($request->input('password'), $user->password)) {
                    return redirect()->route('official_welcome', ['user_id' => $user->id]);
                } else {
                    return redirect('barangay_admin_staff')->with('error', 'Wrong Credentials');
                }
            } elseif ($user->position->title == 'Staff') {
                if (Hash::check($request->input('password'), $user->password)) {
                    return redirect()->route('staff_welcome', ['user_id' => $user->id]);
                } else {
                    return redirect('barangay_admin_staff')->with('error', 'Wrong Credentials');
                }
            } else if ($user->position->title == 'finance') {
                if (Hash::check($request->input('password'), $user->password)) {
                    return redirect()->route('finance_welcome', ['user_id' => $user->id]);
                } else {
                    return redirect('barangay_admin_staff')->with('error', 'Wrong Credentials');
                }
            } else if ($user->position->title == 'chairman') {
                if (Hash::check($request->input('password'), $user->password)) {
                    return redirect()->route('chairman_welcome', ['user_id' => $user->id]);
                } else {
                    return redirect('barangay_admin_staff')->with('error', 'Wrong Credentials');
                }
            }
        } else {
            $resident = Residents::where('email', $request->input('email'))->first();
            if ($resident) {
                if ($resident->status == 'alive') {
                    if (Hash::check($request->input('password'), $resident->password)) {
                        return redirect()->route('resident_welcome', ['resident_id' => $resident->id]);
                    } else {
                        return redirect('/')->with('error', 'Wrong Credentials');
                    }
                } else {
                    return redirect('/')->with('error', 'Account Deactivated. User Dead');
                }
            } else {
                if (isset($barangay_staff)) {
                    return redirect('barangay_admin_staff')->with('error', 'Wrong Credentials');
                } else {
                    return redirect('/')->with('error', 'Wrong Credentials');
                }
            }
        }
    }



    public function finance_welcome($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $complain_report = Complain::where('lupon_id', $user_id)->where('status', 'Approved')->orderBy('id', 'desc')->get();
        $complain_count = Complain::where('lupon_id', $user_id)->where('status', 'Approved')->count();
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();

        $document_request = Document_request::where('barangay_id', $user->barangay_id)
            ->where('status', 'Approved')->orWhere('status', 'Received')->get();

        return view('finance_welcome', [
            'user' => $user,
            'complain_report' => $complain_report,
            'document_request' => $document_request,
            'complain_count' => $complain_count,
            'assistance_count' => $assistance_count,
            'barangay_logo' => $barangay_logo,
        ]);
    }

    public function chairman_welcome($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $complain_report = Complain::where('lupon_id', $user_id)->where('status', 'Approved')->orderBy('id', 'desc')->get();
        $complain_count = Complain::where('lupon_id', $user_id)->where('status', 'Approved')->count();
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();

        $document_request = Document_request::where('barangay_id', $user->barangay_id)->orWhere('status', 'Received')->get();

        return view('chairman_welcome', [
            'user' => $user,
            'complain_report' => $complain_report,
            'document_request' => $document_request,
            'complain_count' => $complain_count,
            'assistance_count' => $assistance_count,
            'barangay_logo' => $barangay_logo,
        ]);
    }

    public function official_welcome($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $complain_count = Complain::where('lupon_id', $user->id)->where('status', 'Approved')->count();
        return view('official_welcome', [
            'user' => $user,
            'assistance_count' => $assistance_count,
            'complain_count' => $complain_count,
        ]);
    }

    public function official_assistance_type($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $type = Assistance_type::where('barangay_id', $user->barangay_id)->get();
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('official_assistance_type', [
            'user' => $user,
            'type' => $type,
            'assistance_count' => $assistance_count,
        ]);
    }

    public function official_assistance_type_process(Request $request)
    {
        $new = new Assistance_type([
            'title' => $request->input('title'),
            'user_id' => $request->input('user_id'),
            'barangay_id' => $request->input('barangay_id'),
        ]);

        $new->save();

        return redirect()->route('official_assistance_type', ['user_id' => $request->input('user_id')])->with('success', 'Successfully added new assistance type');
    }

    public function official_res_registration($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('official_res_registration', [
            'user' => $user,
            'assistance_count' => $assistance_count,
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
        Mail::to($request->input('email'))->send(new send_email_to_resident($email, $password, $first_name, $last_name));

        return redirect()->route('official_res_registration', ['user_id' => $request->input('user_id')])->with('success', 'Successfully added new resident');
    }

    public function official_res_profile($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $resident = Residents::where('barangay_id', $user->barangay_id)->get();
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $complain_count = Complain::where('lupon_id', $user_id)->where('status', 'Approved')->count();
        return view('official_res_profile', [
            'resident' => $resident,
            'user' => $user,
            'assistance_count' => $assistance_count,
            'complain_count' => $complain_count,
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
                'current_address' => $request->input('current_address'),
                'permanent_address' => $request->input('permanent_address'),
                'voter' => $request->input('voter'),
                'fathers_name' => $request->input('fathers_name'),
                'contact_number' => $request->input('contact_number'),
                'spouse' => $request->input('spouse'),
                'status' => $request->input('status'),
            ]);

        return redirect()->route('barangay_resident_profile', ['user_id' => $request->input('user_id')])->with('success', 'Successfully updated resident profile');
    }

    public function official_logout()
    {
        return redirect('barangay_admin_staff');
    }

    public function resident_logout()
    {
        return redirect('/');
    }

    public function official_assistance_request($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $assistance = Assitance::orderBy('status', 'desc')->where('barangay_id', $user->barangay_id)->get();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $complain_count = Complain::where('lupon_id', $user_id)->where('status', 'Approved')->count();
        return view('official_assistance_request', [
            'user' => $user,
            'assistance' => $assistance,
            'barangay_logo' => $barangay_logo,
            'assistance_count' => $assistance_count,
            'complain_count' => $complain_count,
        ]);
    }

    public function staff_document_request_approved($document_request_id, $document_id, $resident_id, $user_id)
    {
        // return $user_id;
        $resident = Residents::find($resident_id);
        $document = Document_type::find($document_id);

        $first_name = $resident->first_name;
        $middle_name = $resident->middle_name;
        $last_name = $resident->last_name;
        $document_name = $document->document_name;
        $document_amount = $document->amount;
        $barangay = $resident->barangay->barangay;

        Mail::to($resident->email)->send(new Document_approved_request($first_name, $middle_name, $last_name, $document_name, $document_amount, $barangay));


        date_default_timezone_set('Asia/Manila');
        $date_time = date('Y-m-d H:i:s');
        Document_request::where('id', $document_request_id)
            ->update([
                'user_id' => $user_id,
                'status' => 'Approved',
                'time_approved' => $date_time,
            ]);

        return redirect()->route('staff_document_request', ['user_id' => $user_id])->with('success', 'Approved Request');
    }

    public function staff_document_request_received($document_request_id, $document_id, $resident_id, $user_id)
    {
        $resident = Residents::find($resident_id);
        $document = Document_type::find($document_id);

        $first_name = $resident->first_name;
        $middle_name = $resident->middle_name;
        $last_name = $resident->last_name;
        $document_name = $document->document_name;
        $document_amount = $document->amount;
        $barangay = $resident->barangay->barangay;

        Mail::to($resident->email)->send(new Document_received($first_name, $middle_name, $last_name, $document_name, $barangay));

        date_default_timezone_set('Asia/Manila');
        $date_time = date('Y-m-d H:i:s');
        Document_request::where('id', $document_request_id)
            ->update([
                'user_id' => $user_id,
                'status' => 'Received',
                'time_received' => $date_time,
            ]);

        return redirect()->route('finance_welcome', ['user_id' => $user_id])->with('success', 'Document Received Successfully');
    }

    public function official_assistance_approved(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        Assitance::where('id', $request->input('assistance_id'))
            ->update([
                'approved_cash' => $request->input('approved_cash'),
                'approved_by_official_id' => $request->input('approved_by_official_id'),
                'approved_date' => $date,
                'reason' => $request->input('reason'),
                'status' => $request->input('status'),
            ]);

        $email = $request->input('resident_email');
        $first_name = $request->input('first_name');
        $middle_name = $request->input('middle_name');
        $last_name = $request->input('last_name');
        $assistance_title = $request->input('assistance_title');
        $barangay = $request->input('barangay');
        $reason = $request->input('reason');
        $approved_cash = number_format($request->input('approved_cash'), 2, ".", ",");

        if ($request->input('status') == 'approved') {
            Mail::to($email)->send(new Assistance_approved_email($middle_name, $first_name, $last_name, $assistance_title, $approved_cash, $barangay));
        } else {
            Mail::to($email)->send(new Disapproved($middle_name, $first_name, $last_name, $assistance_title, $approved_cash, $barangay, $reason));
        }

        return redirect()->route('official_assistance_request', ['user_id' => $request->input('approved_by_official_id')])->with('success', 'Successfully approved request cash assistance');
    }

    public function official_profile($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $assistance = Assitance::orderBy('status', 'desc')->where('barangay_id', $user->barangay_id)->get();
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $complain_count = Complain::where('lupon_id', $user_id)->where('status', 'Approved')->count();
        return view('official_profile', [
            'user' => $user,
            'assistance' => $assistance,
            'assistance_count' => $assistance_count,
            'complain_count' => $complain_count,
        ]);
    }

    public function official_profile_update(Request $request)
    {
        //return $request->input();

        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Barangay_officials::where('id', $request->input('official_id'))
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



        return redirect()->route('official_profile', ['user_id' => $request->input('official_id')])->with('success', 'Successfully updated your profile');
    }

    public function official_profile_update_image(Request $request)
    {
        $validated = $request->validate([
            'user_image' => ['required'],
        ]);

        $user_image = $request->file('user_image');
        $image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $image_name);

        Barangay_officials::where('id', $request->input('official_id'))
            ->update([
                'user_image' => $image_name,
            ]);

        return redirect()->route('official_profile', ['user_id' => $request->input('official_id')])->with('success', 'Successfully updated your profile');
    }

    public function official_complain_report($user_id)
    {


        $user = Barangay_officials::find($user_id);
        $complain_report = Complain::where('lupon_id', $user_id)->where('status', 'Approved')->orderBy('id', 'desc')->get();
        $complain_count = Complain::where('lupon_id', $user_id)->where('status', 'Approved')->count();
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('official_complain_report', [
            'user' => $user,
            'complain_report' => $complain_report,
            'complain_count' => $complain_count,
            'assistance_count' => $assistance_count,
        ]);
    }

    public function staff_welcome($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $complain_report = Complain::where('lupon_id', $user_id)->where('status', 'Approved')->orderBy('id', 'desc')->get();
        $complain_count = Complain::where('lupon_id', $user_id)->where('status', 'Approved')->count();
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        return view('staff_welcome', [
            'user' => $user,
            'complain_report' => $complain_report,
            'complain_count' => $complain_count,
            'assistance_count' => $assistance_count,
            'barangay_logo' => $barangay_logo,
        ]);
    }

    public function staff_document_request($user_id)
    {
        //return $user_id;
        $user = Barangay_officials::find($user_id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();

        $document_request = Document_request::where('barangay_id', $user->barangay_id)->get();

        return view('staff_document_request', [
            'request_count' => $request_count,
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'document_request' => $document_request,
        ]);
    }



    public function staff_complain_report($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $complain = Complain::orderBy('id', 'desc')->where('barangay_id', $user->barangay_id)->get();
        $lupon = Barangay_officials::where('barangay_id', $user->barangay_id)->get();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();

        return view('staff_complain_report', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'complain' => $complain,
            'lupon' => $lupon,
            'request_count' => $request_count,
        ]);
    }

    public function staff_resident_profile($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $resident = Residents::where('barangay_id', $user->barangay_id)->get();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('staff_resident_profile', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'resident' => $resident,
            'request_count' => $request_count,
            'complain_count' => $complain_count,
        ]);
    }

    public function staff_resident_search(Request $request)
    {
        $user = Barangay_officials::find($request->input('user_id'));
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $resident = Residents::where('barangay_id', $user->barangay_id)->get();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $search = $request->input('search_box');
        $resident_search = Residents::where('first_name', 'like', '%' . $search . '%')->orWhere('last_name', 'like', '%' . $search . '%')->orderBy('id', 'DESC')->get();

        return view('staff_resident_search', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'resident' => $resident,
            'request_count' => $request_count,
            'complain_count' => $complain_count,
            'resident_search' => $resident_search,
        ]);
    }

    // public function staff_assistance($user_id)
    // {
    //     $user = Barangay_officials::where('id',$user_id)->first();
    //     $assistance = Assitance::orderBy('status', 'desc')->where('barangay_id', $user->barangay_id)->get();

    //     return view('staff_assistance',[
    //         'user' => $user,
    //         'assistance' => $assistance,
    //     ]);
    // }
}
