<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barangay;
use App\Models\Barangay_position;
use App\Models\Barangay_officials;
use App\Models\Barangay_logo;
use App\Models\Residents;
use App\Models\Complain;
use App\Models\Document_type;
use App\Models\Document_request;

use App\Mail\send_mail_to_resident;
use App\Mail\Approved_complains;
use App\Mail\Approved_complains_respondent;
use App\Mail\Approved_complains_lupon;
use App\Mail\Document_approved_request;
use App\Mail\Document_received;




use App\Mail\send_email_to_resident;
use App\Mail\Assistance_approved_email;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class Barangay_controller extends Controller
{
    public function proceeding(Request $request)
    {
        $validated = $request->validate([
            'longitude' => 'required',
            'latitude' => 'required',
            'barangay' => 'required',
        ]);

        return view('proceeding')
            ->with('longitude', $request->input('longitude'))
            ->with('latitude', $request->input('latitude'))
            ->with('barangay', $request->input('barangay'));
    }

    public function proceeding_register(Request $request)
    {
        //dd($request->all());

        $validated = $request->validate([
            'user_image' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contact_number' => ['required', 'numeric', 'min:11'],
            'invitation_code' => ['required', 'regex:(sample)'],
        ]);

        $barangay = new Barangay([
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'barangay' => $request->input('barangay'),
        ]);

        $barangay->save();

        $user_image = $request->file('user_image');
        $image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $image_name);


        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'contact_number' => $request->input('contact_number'),
            'user_image' => $image_name,
            'barangay_id' => $barangay->id,
            'user_type' => 'barangay_admin',
        ]);

        $user->save();

        return redirect('barangay_admin_login')->with('success', 'Successfully created admin account, You can now login');
    }

    public function barangay_admin_login()
    {
        return view('barangay_admin_login');
    }

    public function home()
    {
        $user = User::find(auth()->user()->id);
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('home', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'request_count' => $request_count,
        ]);
    }

    public function register_officials()
    {
        return view('register_officials');
    }

    public function barangay_position()
    {
        $user = User::find(auth()->user()->id);
        $position = Barangay_position::orderBy('id', 'desc')->get();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('barangay_position', [
            'position' => $position,
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'request_count' => $request_count,
        ]);
    }

    public function barangay_position_process(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $position = new Barangay_position([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => 'enabled',
        ]);

        $position->save();

        return redirect('barangay_position')->with('success', 'Successfully added new barangay position');
    }

    public function barangay_position_update(Request $request)
    {
        Barangay_position::where('id', $request->input('id'))
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);

        return redirect('barangay_position')->with('success', 'Successfully updated barangay position');
    }

    public function barangay_position_delete($id)
    {
        $deleted = DB::table('barangay_positions')->where('id', $id)->delete();

        return redirect('barangay_position')->with('success', 'Successfully deleted barangay position');
    }

    public function barangay_register()
    {
        $user = User::find(auth()->user()->id);
        $position = Barangay_position::get();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('barangay_register', [
            'position' => $position,
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'request_count' => $request_count,
        ]);
    }

    public function barangay_register_process(Request $request)
    {

        //return $request->input();

        $validated = $request->validate([
            'user_image' => 'required',
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => 'required|not_in:0',
            'civil_status' => 'required|not_in:0',
            'position_type_id' => 'required|not_in:0',
            'birth_date' => 'required',
            'office_term' => 'required',
            'contact_number' => ['required', 'numeric', 'min:11'],
            'spouse' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:barangay_officials'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user_image = $request->file('user_image');
        $image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $image_name);

        $user = User::find(auth()->user()->id);

        $officials = new Barangay_officials([
            'user_image' => $image_name,
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'civil_status' => $request->input('civil_status'),
            'position_type_id' => $request->input('position_type_id'),
            'birth_date' => $request->input('birth_date'),
            'office_term' => $request->input('office_term'),
            'contact_number' => $request->input('contact_number'),
            'spouse' => $request->input('spouse'),
            'email' => $request->input('email'),
            'password' => hash::make($request->input('password')),
            'barangay_id' => $user->barangay_id,
        ]);

        $officials->save();

        return redirect('barangay_register')->with('success', 'Successfully added new barangay official');
    }

    public function barangay_officials_profile()
    {
        $user = User::find(auth()->user()->id);
        $position = Barangay_position::get();
        $officials = Barangay_officials::where('barangay_id', $user->barangay_id)->get();
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('barangay_officials_profile', [
            'officials' => $officials,
            'position' => $position,
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'request_count' => $request_count,
        ]);
    }

    public function barangay_official_update(Request $request)
    {
        Barangay_officials::where('id', $request->input('id'))
            ->update([
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'gender' => $request->input('gender'),
                'civil_status' => $request->input('civil_status'),
                'position_type_id' => $request->input('position_type_id'),
                'birth_date' => $request->input('birth_date'),
                'office_term' => $request->input('office_term'),
                'contact_number' => $request->input('contact_number'),
                'email' => $request->input('email'),
                'spouse' => $request->input('spouse'),
                'email' => $request->input('email'),
                'password' => hash::make($request->input('password')),
            ]);

        return redirect('barangay_officials_profile')->with('success', 'Successfully updated profile');
    }

    public function barangay_logout()
    {
        Auth::logout();

        return redirect('barangay_admin_login');
    }

    public function barangay_logo()
    {
        $user = User::find(auth()->user()->id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('barangay_logo', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'request_count' => $request_count,
        ]);
    }

    public function barangay_logo_process(Request $request)
    {
        $validated = $request->validate([
            'logo' => 'required',
        ]);

        $barangay_logo = Barangay_logo::where('barangay_id', $request->input('barangay_id'))->first();

        if ($barangay_logo) {
            $user_image = $request->file('logo');
            $image_name = 'logo-' . time() . '.' . $user_image->getClientOriginalExtension();
            $path_user_image = $user_image->storeAs('public', $image_name);

            Barangay_logo::where('id', $barangay_logo->id)
                ->update([
                    'logo' => $image_name,
                ]);
        } else {

            $user_image = $request->file('logo');
            $image_name = 'logo-' . time() . '.' . $user_image->getClientOriginalExtension();
            $path_user_image = $user_image->storeAs('public', $image_name);

            $new_logo = new Barangay_logo([
                'barangay_id' => $request->input('barangay_id'),
                'user_id' => $request->input('user_id'),
                'logo' => $image_name,
            ]);

            $new_logo->save();
        }


        return redirect('barangay_logo')->with('success', 'Successfully uploaded barangay logo');
    }

    public function barangay_resident_register()
    {
        $user = User::find(auth()->user()->id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('barangay_resident_register', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'request_count' => $request_count,
        ]);
    }

    public function barangay_resident_register_process(Request $request)
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
            'contact_number' => $request->input('contact_number'),
            'spouse' => $request->input('spouse'),
            'email' => $request->input('email'),
            'password' => hash::make($password),
            'user_id' => $request->input('user_id'),
            'barangay_id' => $request->input('barangay_id'),
        ]);

        $officials->save();

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        Mail::to($request->input('email'))->send(new send_email_to_resident($email, $password, $first_name, $last_name));

        return redirect()->route('barangay_resident_register')->with('success', 'Successfully added new resident');
    }

    public function barangay_resident_profile()
    {
        $user = User::find(auth()->user()->id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $resident = Residents::where('barangay_id', $user->barangay_id)->get();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('barangay_resident_profile', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'resident' => $resident,
            'request_count' => $request_count,
        ]);
    }

    public function barangay_profile()
    {
        $user = User::find(auth()->user()->id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $resident = Residents::where('barangay_id', $user->barangay_id)->get();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();
        return view('barangay_profile', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'resident' => $resident,
            'complain_count' => $complain_count,
            'request_count' => $request_count,
        ]);
    }

    public function barangay_profile_update_process(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::where('id', $request->input('user_id'))
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'contact_number' => $request->input('contact_number'),
                'password' => Hash::make($request->input('password')),
            ]);

        return redirect()->route('barangay_profile')->with('success', 'Successfully updated your profile');
    }

    public function barangay_profile_update_image(Request $request)
    {
        $validated = $request->validate([
            'user_image' => ['required'],
        ]);

        $user_image = $request->file('user_image');
        $image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $image_name);

        User::where('id', $request->input('user_id'))
            ->update([
                'user_image' => $image_name,
            ]);

        return redirect()->route('barangay_profile')->with('success', 'Successfully updated your profile');
    }

    public function barangay_complain_report()
    {
        $user = User::find(auth()->user()->id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $complain = Complain::orderBy('id', 'desc')->get();
        $lupon = Barangay_officials::where('barangay_id', $user->barangay_id)->get();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();

        return view('barangay_complain_report', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'complain' => $complain,
            'lupon' => $lupon,
            'request_count' => $request_count,
        ]);
    }

    public function barangay_complain_approved(Request $request)
    {

        $explode = explode('-', $request->input('lupon_id'));
        $lupon_id = $explode[0];
        $lupon_email = $explode[1];
        $lupon_data = Barangay_officials::find($lupon_id);
        $complainant_id = $request->input('complainant_id');
        $complainant_first_name = $request->input('complainant_first_name');
        $complainant_middle_name = $request->input('complainant_middle_name');
        $complainant_last_name = $request->input('complainant_last_name');
        $respondent_id = $request->input('respondent_id');
        $respondent_first_name = $request->input('respondent_first_name');
        $respondent_middle_name = $request->input('respondent_middle_name');
        $respondent_last_name = $request->input('respondent_last_name');
        $complainant_email = $request->input('complainant_email');
        $respondent_email = $request->input('respondent_email');
        $hearing_date = $request->input('hearing_date');
        $time = $request->input('time');
        $barangay = $request->input('barangay');

        if ($time == 'Morning') {
            $hearing_time = '9:00am';
        } else {
            $hearing_time = '1:30pm';
        }



        Mail::to($complainant_email)->send(new Approved_complains($complainant_first_name, $complainant_middle_name, $complainant_last_name, $hearing_date, $hearing_time, $respondent_first_name, $respondent_middle_name, $respondent_last_name, $barangay));

        Mail::to($respondent_email)->send(new Approved_complains_respondent($respondent_first_name, $respondent_middle_name, $respondent_last_name, $complainant_first_name, $complainant_middle_name, $complainant_last_name, $hearing_date, $hearing_time, $barangay));

        Mail::to($lupon_email)->send(new Approved_complains_lupon($lupon_data->first_name, $lupon_data->middle_name, $lupon_data->last_name, $hearing_date, $hearing_time, $complainant_first_name, $complainant_middle_name, $complainant_last_name, $respondent_first_name, $respondent_middle_name, $respondent_last_name, $barangay));

        Complain::where('id', $request->input('complain_id'))
            ->update([
                'lupon_id' => $lupon_id,
                'hearing_date' => $request->input('hearing_date'),
                'time' => $hearing_time,
                'status' => 'Approved',
            ]);

        return redirect()->route('barangay_complain_report')->with('success', 'Successfully approved and set schedule for Complain Request No.' . $request->input('complain_id'));
    }

    public function barangay_complain_status_change_to_on_progess(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date_time = date('Y-m-d H:i:s');
        Complain::where('id', $request->input('complain_id'))
            ->update([
                'status' => $request->input('status'),
                'time_started' => $date_time,
            ]);

        return redirect()->route('barangay_complain_report')->with('success', 'Status change to On Progress. Complain No ' . $request->input('complain_id'));
    }

    public function barangay_complain_status_change_to_end(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date_time = date('Y-m-d H:i:s');

        $user_image = $request->file('file');
        $image_name = 'hearing_document-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $image_name);

        Complain::where('id', $request->input('complain_id'))
            ->update([
                'status' => $request->input('status'),
                'time_ended' => $date_time,
                'image' => $image_name,
            ]);

        return redirect()->route('barangay_complain_report')->with('success', 'Status change to On Progress. Complain No ' . $request->input('complain_id'));
    }

    public function barangay_document_type()
    {
        $user = User::find(auth()->user()->id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $document = Document_type::where('barangay_id', $user->barangay_id)->get();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();

        return view('barangay_document_type', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'document' => $document,
            'request_count' => $request_count,
        ]);
    }

    public function barangay_document_save(Request $request)
    {
        $user_image = $request->file('file');
        $image_name = $user_image->getClientOriginalName();
        $path_user_image = $user_image->storeAs('public', $image_name);

        $new = new Document_type([
            'document_name' => $request->input('document_name'),
            'file' => $image_name,
            'amount' => $request->input('amount'),
            'barangay_id' => $request->input('barangay_id'),
        ]);

        $new->save();

        return redirect()->route('barangay_document_type')->with('success', 'Uploaded new Document Type');
    }

    public function barangay_document_type_update($document_id)
    {
        $document_type = Document_type::find($document_id);
        $user = User::find(auth()->user()->id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();

        return view('barangay_document_type_update', [
            'document_type' => $document_type,
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'request_count' => $request_count,
        ]);
    }

    public function barangay_document_type_update_process(Request $request)
    {
        Document_type::where('id', $request->input('document_type_id'))
            ->update([
                'document_name' => $request->input('document_name'),
                'amount' => str_replace('', ',', $request->input('amount')),
            ]);

        return redirect()->route('barangay_document_type')->with('success', 'Successfully updated document type');
    }

    public function barangay_document_type_update_file_process(Request $request)
    {

        $user_image = $request->file('file');
        $image_name = $user_image->getClientOriginalName();
        $path_user_image = $user_image->storeAs('public', $image_name);

        Document_type::where('id', $request->input('document_type_id'))
            ->update([
                'file' => $image_name,
            ]);

        return redirect()->route('barangay_document_type')->with('success', 'Successfully updated document template');
    }

    public function barangay_document_request()
    {
        $user = User::find(auth()->user()->id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('status', 'Pending Approval')->where('barangay_id', $user->barangay_id)->count();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();

        $document_request = Document_request::where('barangay_id', $user->barangay_id)->get();

        return view('barangay_document_request', [
            'request_count' => $request_count,
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'document_request' => $document_request,
        ]);
    }

    public function barangay_document_request_approved($document_request_id, $document_id, $resident_id)
    {

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
                'user_id' => auth()->user()->id,
                'status' => 'Approved',
                'time_approved' => $date_time,
            ]);

        return redirect()->route('barangay_document_request')->with('success', 'Approved Request');
    }

    public function barangay_document_request_received($document_request_id, $document_id, $resident_id)
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
                'user_id' => auth()->user()->id,
                'status' => 'Received',
                'time_received' => $date_time,
            ]);

        return redirect()->route('barangay_document_request')->with('success', 'Document Received Successfully');
    }

    public function barangay_dashboard()
    {
        $user = User::find(auth()->user()->id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $complain_count = Complain::where('barangay_id', $user->barangay_id)->count();
        $pending_count = Complain::where('barangay_id', $user->barangay_id)->where('status','')->count();
        $approved_count = Complain::where('barangay_id', $user->barangay_id)->where('status','Approved')->count();
        $progress_count = Complain::where('barangay_id', $user->barangay_id)->where('status','On Progress')->count();
        $end_count = Complain::where('barangay_id', $user->barangay_id)->where('status','End')->count();

        $document_count = Document_request::where('barangay_id', $user->barangay_id)->count();
        $new_request_count = Document_request::where('barangay_id', $user->barangay_id)->where('status','New Request')->count();
        $d_approved_count = Document_request::where('barangay_id', $user->barangay_id)->where('status','Approved')->count();
        $received_count = Document_request::where('barangay_id', $user->barangay_id)->where('status','Received')->count();


        $document = Document_type::where('barangay_id', $user->barangay_id)->get();
        $request_count = Document_request::where('status', 'New Request')->where('barangay_id', $user->barangay_id)->count();

        return view('barangay_dashboard', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'complain_count' => $complain_count,
            'document' => $document,
            'request_count' => $request_count,
            'pending_count' => $pending_count,
            'approved_count' => $approved_count,
            'progress_count' => $progress_count,
            'end_count' => $end_count,
            'document_count' => $document_count,
            'new_request_count' => $new_request_count,
            'd_approved_count' => $d_approved_count,
            'received_count' => $received_count,
        ]);
    }
}
