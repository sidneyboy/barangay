<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Barangay_message;
use App\Models\User;
use App\Models\User_logs;

use App\Mail\Message_barangay_mail;




use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Super_user_controller extends Controller
{
    public function super_user_login()
    {
        return view('super_user_login');
    }

    public function super_user_login_process(Request $request)
    {
        //return $request->input();
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            if ($user->user_type == 'barangay_super_user') {
                if (Hash::check($request->input('password'), $user->password)) {
                    return redirect()->route('super_user_dashboard', ['user_id' => $user->id]);
                } else {
                    return redirect('super_user_login')->with('error', 'Wrong Credentials');
                }
            } elseif ($user->user_type == 'barangay_validator') {
                if (Hash::check($request->input('password'), $user->password)) {
                    return redirect()->route('super_user_dashboard', ['user_id' => $user->id]);
                } else {
                    return redirect('super_user_login')->with('error', 'Wrong Credentials');
                }
            } else {
                return redirect('super_user_login')->with('error', 'You dont have permission to access this site!');
            }
        } else {
            return redirect('super_user_login')->with('error', 'Wrong Credentials');
        }
    }

    public function super_user_dashboard($user_id)
    {
        $barangay = Barangay::get();
        $user = User::find($user_id);
        $active = 'dashboard';
        return view('super_user_dashboard', [
            'user' => $user,
            'barangay' => $barangay,
            'active' => $active,
        ]);
    }

    public function super_user_logut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('super_user_login');
    }

    public function status_approval($user_id, $status, $barangay_id)
    {
        date_default_timezone_set('Asia/Manila');
        $date_time = date('Y-m-d H:i:s');
        $barangay_name = Barangay::find($barangay_id);
        if ($status == 'Pending Approval') {
            Barangay::where('id', $barangay_id)
                ->update(['status' => 'Approved']);

            $new_logs = new User_logs([
                'user_id' => $user_id,
                'content' => 'Changed ' . $barangay_name->barangay . ' status to Enabled',
                'created_at' => $date_time,
            ]);

            $new_logs->save();

            return redirect()->route('super_user_dashboard', ['user_id' => $user_id])->with('success', 'Selected barangay approved successfully');
        } else {
            Barangay::where('id', $barangay_id)
                ->update(['status' => 'Pending Approval']);

            $new_logs = new User_logs([
                'user_id' => $user_id,
                'content' => 'Changed ' . $barangay_name->barangay . ' status to Disabled',
                'created_at' => $date_time,
            ]);

            $new_logs->save();

            return redirect()->route('super_user_dashboard', ['user_id' => $user_id])->with('success', 'Selected barangay deactivated successfully');
        }
    }

    public function super_user_message_barangay(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date_time = date('Y-m-d H:i:s');
        // return $request->input();
        $new_message = new Barangay_message([
            'barangay_id' => $request->input('barangay_id'),
            'message' => $request->input('message'),
        ]);

        $new_message->save();

        $barangay = User::where('barangay_id', $request->input('barangay_id'))->first();
        $barangay_name = $barangay->barangay->barangay;
        $message = $request->input('message');

        Mail::to($barangay->email)->send(new Message_barangay_mail($barangay_name, $message));

        $new_logs = new User_logs([
            'user_id' => $request->input('user_id'),
            'content' => 'Sent Messaage to barangay ' . $barangay_name . ' saying ' . $message,
            'created_at' => $date_time,
        ]);

        $new_logs->save();

        return redirect()->route('super_user_dashboard', ['user_id' => $request->input('user_id')])->with('success', 'Message successfully sent');
    }

    public function super_user_registration($user_id)
    {
        $user = User::find($user_id);
        $active = 'super_user_registration';
        return view('super_user_registration', [
            'user' => $user,
            'active' => $active,
        ]);
    }

    public function super_user_registration_process(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date_time = date('Y-m-d H:i:s');
        $new = new User([
            'name' => $request->input('name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => hash::make($request->input('password')),
            'user_type' => $request->input('user_type'),
        ]);

        $new->save();

        $new_logs = new User_logs([
            'user_id' => $request->input('user_id'),
            'content' => 'Registered new user ' . $request->input('name') . " " . $request->input('middle_name') . " " . $request->input('last_name'),
            'created_at' => $date_time,
        ]);

        $new_logs->save();

        return redirect()->route('super_user_registration', ['user_id' => $request->input('user_id')])->with('success', 'Registered successfully');
    }

    public function super_user_logs($user_id)
    {
        $user = User::find($user_id);
        $active = 'super_user_logs';
        $user_logs = User_logs::get();
        return view('super_user_logs', [
            'user' => $user,
            'user_logs' => $user_logs,
            'active' => $active,
        ]);
    }
}
