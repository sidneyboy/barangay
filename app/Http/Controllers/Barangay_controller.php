<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barangay;
use App\Models\Barangay_position;
use App\Models\Barangay_officials;
use App\Models\Barangay_logo;
use App\Models\Residents;

use App\Mail\send_mail_to_resident;

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
            'region' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
        ]);

        return view('proceeding')
            ->with('region', $request->input('region'))
            ->with('province', $request->input('province'))
            ->with('city', $request->input('city'))
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
            'region' => $request->input('region'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
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
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        return view('home', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
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
        return view('barangay_position', [
            'position' => $position,
            'user' => $user,
            'barangay_logo' => $barangay_logo,
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
        return view('barangay_register', [
            'position' => $position,
            'user' => $user,
            'barangay_logo' => $barangay_logo,
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

        return view('barangay_officials_profile', [
            'officials' => $officials,
            'position' => $position,
            'user' => $user,
            'barangay_logo' => $barangay_logo,
        ]);
    }

    public function barangay_official_update(Request $request)
    {
        //return $request->input();

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
        return view('barangay_logo', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
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
        return view('barangay_resident_register', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
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
        return view('barangay_resident_profile', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'resident' => $resident,
        ]);
    }

    public function barangay_profile()
    {
        $user = User::find(auth()->user()->id);
        $barangay_logo = Barangay_logo::select('logo')->where('barangay_id', $user->barangay_id)->first();
        $resident = Residents::where('barangay_id', $user->barangay_id)->get();
        return view('barangay_profile', [
            'user' => $user,
            'barangay_logo' => $barangay_logo,
            'resident' => $resident,
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
}
