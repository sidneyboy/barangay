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
use App\Models\Employement_record;
use App\Models\Resident_education;
use App\Models\Resident_households;


use App\Mail\send_email_to_resident;
use App\Mail\Assistance_approved_email;
use App\Mail\Disapproved;
use App\Mail\Document_approved_request;
use App\Mail\Document_received;

use App\Models\Zone;




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
        if ($user) {
            if ($user->barangay->status != 'Pending Approval') {
                if ($user->position->title == 'Lupon') {
                    if (Hash::check($request->input('password'), $user->password)) {
                        return redirect()->route('official_welcome', ['user_id' => $user->id]);
                    } else {
                        return redirect('barangay_admin_staff')->with('error', 'Wrong Credentials');
                    }
                } elseif ($user->position->title == 'Staff') {
                    if (Hash::check($request->input('password'), $user->password)) {
                        return redirect()->route('staff_document_request', ['user_id' => $user->id]);
                    } else {
                        return redirect('barangay_admin_staff')->with('error', 'Wrong Credentials');
                    }
                } else if ($user->position->title == 'Finance') {
                    if (Hash::check($request->input('password'), $user->password)) {
                        return redirect()->route('finance_welcome', ['user_id' => $user->id]);
                    } else {
                        return redirect('barangay_admin_staff')->with('error', 'Wrong Credentials');
                    }
                } else if ($user->position->title == 'Chairman') {
                    if (Hash::check($request->input('password'), $user->password)) {
                        return redirect()->route('chairman_welcome', ['user_id' => $user->id]);
                    } else {
                        return redirect('barangay_admin_staff')->with('error', 'Wrong Credentials');
                    }
                } else if ($user->position->title == 'Census') {

                    if (Hash::check($request->input('password'), $user->password)) {
                        return redirect()->route('census_register_resident', ['user_id' => $user->id]);
                    } else {
                        return redirect('official_login')->with('error', 'Wrong Credentials');
                    }
                }
            } else {
                return redirect('barangay_admin_staff')->with('error', 'Barangay Deactivated. Cannot Login!');
            }
        } else {

            $resident = Residents::where('email', $request->input('email'))->first();
            if ($resident) {
                if ($resident->barangay->status != 'Pending Approval') {
                    if ($resident->status == 'alive') {;
                        if (Hash::check($request->input('password'), $resident->password)) {
                            return redirect()->route('resident_welcome', ['resident_id' => $resident->id]);
                        } else {
                            return redirect('/')->with('error', 'Wrong Credentials');
                        }
                    } else {
                        return redirect('/')->with('error', 'Account Deactivated. User Dead');
                    }
                } else {
                    return redirect('official_login')->with('error', 'Barangay Deactivated. Cannot Login!');
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

    public function census_register_resident($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $zone = Zone::get();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $active = 'census_register_resident';
        return view('census_register_resident', [
            'user' => $user,
            'zone' => $zone,
            'active' => $active,
            'barangay_logo' => $barangay_logo,
        ]);
    }

    // public function official_resident_registration_process(Request $request)
    // {
    //     $user_image = $request->file('user_image');
    //     $image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
    //     $path_user_image = $user_image->storeAs('public', $image_name);

    //     // $user = Barangay_officials::find($request->input('user_id'));

    //     $password = uniqid();

    //     $officials = new Residents([
    //         'user_image' => $image_name,
    //         'first_name' => $request->input('first_name'),
    //         'middle_name' => $request->input('middle_name'),
    //         'last_name' => $request->input('last_name'),
    //         'gender' => $request->input('gender'),
    //         'civil_status' => $request->input('civil_status'),
    //         'birth_date' => $request->input('birth_date'),
    //         'mothers_name' => $request->input('mothers_name'),
    //         'fathers_name' => $request->input('fathers_name'),
    //         'permanent_address' => $request->input('permanent_address'),
    //         'current_address' => $request->input('current_address'),
    //         'contact_number' => $request->input('contact_number'),
    //         'spouse' => $request->input('spouse'),
    //         'email' => $request->input('email'),
    //         'zone' => $request->input('zone'),
    //         'voter' => $request->input('voter'),
    //         'password' => hash::make($password),
    //         'user_id' => $request->input('user_id'),
    //         'status' => 'alive',
    //         'barangay_id' => $request->input('barangay_id'),
    //         'present_house_block' => $request->input('present_house_block'),
    //         'present_subd' => $request->input('present_subd'),
    //         'present_municipality' => $request->input('present_municipality'),
    //         'present_province' => $request->input('present_province'),
    //         'present_living_status' => $request->input('present_living_status'),
    //         'present_length_of_stay' => $request->input('present_length_of_stay'),
    //         'provincial_house_block' => $request->input('provincial_house_block'),
    //         'provincial_subd' => $request->input('provincial_subd'),
    //         'provincial_municipality' => $request->input('provincial_municipality'),
    //         'provincial_province' => $request->input('provincial_province'),
    //     ]);

    //     $officials->save();
    // }

    public function offical_resident_registration_process(Request $request)
    {
        //return $request->input();
        $user_image = $request->file('user_image');
        $image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $image_name);

        // $user = Barangay_officials::find($request->input('user_id'));

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
            'permanent_address' => $request->input('permanent_address'),
            'current_address' => $request->input('current_address'),
            'contact_number' => $request->input('contact_number'),
            'spouse' => $request->input('spouse'),
            'email' => $request->input('email'),
            'zone' => $request->input('zone'),
            'voter' => $request->input('voter'),
            'password' => hash::make($password),
            'user_id' => $request->input('user_id'),
            'status' => 'alive',
            'barangay_id' => $request->input('barangay_id'),
            'present_house_block' => $request->input('present_house_block'),
            'present_subd' => $request->input('present_subd'),
            'present_municipality' => $request->input('present_municipality'),
            'present_province' => $request->input('present_province'),
            'present_living_status' => $request->input('present_living_status'),
            'present_length_of_stay' => $request->input('present_length_of_stay'),
            'provincial_house_block' => $request->input('provincial_house_block'),
            'provincial_subd' => $request->input('provincial_subd'),
            'provincial_municipality' => $request->input('provincial_municipality'),
            'provincial_province' => $request->input('provincial_province'),
            'height' => $request->input('height'),
            'weight' => $request->input('weight'),
        ]);

        $officials->save();
        //return $request->input();

        $elementary_school = $request->input('elementary_school');
        if (isset($elementary_school)) {
            if (count($request->input('elementary_school')) != 0) {
                for ($i = 0; $i < count($request->input('elementary_school')); $i++) {

                    $new_education_elementary = new Resident_education([
                        'resident_id' => $officials->id,
                        'level_of_education' => 'Elementary',
                        'school' => $request->input('elementary_school')[$i],
                        'address' => $request->input('elementary_address')[$i],
                    ]);

                    $new_education_elementary->save();
                }
            }
        }

        $highschool_school = $request->input('highschool_school');
        if (isset($highschool_school)) {
            if (count($request->input('highschool_school')) != 0) {
                for ($x = 0; $x < count($request->input('highschool_school')); $x++) {
                    $new_education_highschool = new Resident_education([
                        'resident_id' => $officials->id,
                        'level_of_education' => 'High School',
                        'school' => $request->input('highschool_school')[$x],
                        'address' => $request->input('highschool_address')[$x],
                    ]);

                    $new_education_highschool->save();
                }
            }
        }

        $vocation_course_school = $request->input('vocation_course_school');
        if (isset($vocation_course_school)) {
            if (count($request->input('vocation_course_school')) != 0) {
                for ($y = 0; $y < count($request->input('vocation_course_school')); $y++) {
                    $new_education_vocation = new Resident_education([
                        'resident_id' => $officials->id,
                        'level_of_education' => 'Vocational Course',
                        'school' => $request->input('vocation_course_school')[$y],
                        'address' => $request->input('vocation_course_address')[$y],
                    ]);

                    $new_education_vocation->save();
                }
            }
        }

        $college_school = $request->input('college_school');
        if (isset($college_school)) {
            if (count($request->input('college_school')) != 0) {
                for ($p = 0; $p < count($request->input('college_school')); $p++) {
                    $new_education_college = new Resident_education([
                        'resident_id' => $officials->id,
                        'level_of_education' => 'College',
                        'school' => $request->input('college_school')[$p],
                        'address' => $request->input('college_address')[$p],
                    ]);

                    $new_education_college->save();
                }
            }
        }

        $duration = $request->input('duration');
        if (isset($duration)) {
            if (count($request->input('duration')) != 0) {
                for ($u = 0; $u < count($request->input('duration')); $u++) {
                    $new_employment = new Employement_record([
                        'resident_id' => $officials->id,
                        'duration' => $request->input('duration')[$u],
                        'company' => $request->input('company')[$u],
                        'address' => $request->input('address')[$u],
                    ]);

                    $new_employment->save();
                }
            }
        }


        $house_hold_name = $request->input('house_hold_name');
        if (isset($house_hold_name)) {
            if (count($request->input('house_hold_name')) != 0) {
                for ($b = 0; $b < count($request->input('house_hold_name')); $b++) {
                    $new_house = new Resident_households([
                        'resident_id' => $officials->id,
                        'name' => $request->input('house_hold_name')[$b],
                        'position' => $request->input('house_hold_position')[$b],
                        'age' => $request->input('house_hold_age')[$b],
                        'birth_date' => $request->input('house_hold_birth_date')[$b],
                        'civil_status' => $request->input('house_hold_birth_civil_status')[$b],
                        'occupation' => $request->input('house_hold_birth_occupation')[$b],
                    ]);

                    $new_house->save();
                }
            }
        }





        //return $request->input('user_id');
        $user = Barangay_officials::find($request->input('user_id'));
        $barangay = $user->barangay->barangay;
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        Mail::to($request->input('email'))->send(new send_email_to_resident($email, $password, $first_name, $last_name, $barangay));

        return redirect()->route('census_register_resident',['user_id' => $request->input('user_id')])->with('success', 'Successfully added new resident');
    }

    public function finance_welcome($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $complain_report = Complain::where('barangay_id', $user->barangay_id)->orderBy('id', 'desc')->get();
        $complain_count = Complain::where('barangay_id', $user->barangay_id)->count();
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $active = 'active';

        $document_request = Document_request::where('barangay_id', $user->barangay_id)->get();


        return view('finance_welcome', [
            'user' => $user,
            'complain_report' => $complain_report,
            'document_request' => $document_request,
            'complain_count' => $complain_count,
            'assistance_count' => $assistance_count,
            'barangay_logo' => $barangay_logo,
            'active' => $active,
        ]);
    }

    public function chairman_welcome($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $complain_report = Complain::where('barangay_id', $user->barangay_id)->orderBy('id', 'desc')->get();
        $complain_count = Complain::where('barangay_id', $user->barangay_id)->count();
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();

        $document_request = Document_request::where('barangay_id', $user->barangay_id)->get();

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
        $complain_count = Complain::where('status', 'Approved')->where('barangay_id', $user->barangay_id)->count();
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
        $complain_count = Complain::where('barangay_id', $user->barangay_id)->where('status', 'Approved')->count();
        $active = 'official_res_profile';

        return view('official_res_profile', [
            'resident' => $resident,
            'user' => $user,
            'assistance_count' => $assistance_count,
            'complain_count' => $complain_count,
            'official_res_profile' => $active,
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
        $complain_count = Complain::where('status', 'Approved')->where('barangay_id', $user->barangay_id)->count();
        $active = 'official_assistance_request';

        return view('official_assistance_request', [
            'user' => $user,
            'assistance' => $assistance,
            'barangay_logo' => $barangay_logo,
            'assistance_count' => $assistance_count,
            'complain_count' => $complain_count,
            'active' => $active,
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
        $complain_count = Complain::where('status', 'Approved')->where('barangay_id', $user->barangay_id)->count();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $active = 'official_profile';
        return view('official_profile', [
            'user' => $user,
            'assistance' => $assistance,
            'assistance_count' => $assistance_count,
            'complain_count' => $complain_count,
            'barangay_logo' => $barangay_logo,
            'active' => $active,
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
        $complain_report = Complain::where('status', 'Approved')->where('barangay_id', $user->barangay_id)->orderBy('id', 'desc')->get();
        $complain_count = Complain::where('status', 'Approved')->where('barangay_id', $user->barangay_id)->count();
        $assistance_count = Assitance::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $active = 'official_complain_report';

        return view('official_complain_report', [
            'user' => $user,
            'complain_report' => $complain_report,
            'complain_count' => $complain_count,
            'assistance_count' => $assistance_count,
            'active' => $active,
        ]);
    }

    public function staff_welcome($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $complain_report = Complain::where('status', 'Approved')->where('barangay_id', $user->barangay_id)->orderBy('id', 'desc')->get();
        $complain_count = Complain::where('status', 'Approved')->where('barangay_id', $user->barangay_id)->count();
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
        $active = 'staff_document_request';


        return view('staff_document_request', [
            'request_count' => $request_count,
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'document_request' => $document_request,
            'active' => $active,
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
        $active = 'staff_complain_report';


        return view('staff_complain_report', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'complain' => $complain,
            'lupon' => $lupon,
            'request_count' => $request_count,
            'active' => $active,
        ]);
    }

    public function staff_resident_profile($user_id)
    {
        $user = Barangay_officials::find($user_id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $resident = Residents::where('barangay_id', $user->barangay_id)->get();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        $active = 'staff_resident_profile';

        return view('staff_resident_profile', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'resident' => $resident,
            'request_count' => $request_count,
            'complain_count' => $complain_count,
            'active' => $active,
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

    public function print_document($id, $document_id)
    {

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $year = date('Y');
        $month = date('F');
        $day = date('d');
        $month_label_for_agent_performance = date('F');
        $resident = Residents::find($id);
        $barangay_officials = Barangay_officials::where('barangay_id', $resident->barangay_id)->get();

        $document = Document_request::find($document_id);
        return view('print_document', [
            'resident' => $resident,
            'barangay_officials' => $barangay_officials,
            'year' => $year,
            'document' => $document,
            'month' => $month,
            'day' => $day,
            'date' => $date,
            'month_label_for_agent_performance' => $month_label_for_agent_performance,
        ]);
    }
}
