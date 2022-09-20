<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Barangay_message;
use App\Models\User;

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
                    // return redirect('/')->with('error', 'Wrong Credentials');
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
        return view('super_user_dashboard', [
            'user' => $user,
            'barangay' => $barangay,
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
        if ($status == 'Pending Approval') {
            Barangay::where('id', $barangay_id)
                ->update(['status' => 'Approved']);

            return redirect()->route('super_user_dashboard', ['user_id' => $user_id])->with('success', 'Selected barangay approved successfully');
        } else {
            Barangay::where('id', $barangay_id)
                ->update(['status' => 'Pending Approval']);

            return redirect()->route('super_user_dashboard', ['user_id' => $user_id])->with('success', 'Selected barangay deactivated successfully');
        }
    }

    public function super_user_message_barangay(Request $request)
    {
       // return $request->input();
        $new_message = new Barangay_message([
            'barangay_id' => $request->input('barangay_id'),
            'message' => $request->input('message'),
        ]);

        $new_message->save();

        $barangay = User::where('barangay_id',$request->input('barangay_id'))->first();
        $barangay_name = $barangay->barangay->barangay;
        $message = $request->input('message');

        Mail::to($barangay->email)->send(new Message_barangay_mail($barangay_name,$message));

        return redirect()->route('super_user_dashboard', ['user_id' => $request->input('user_id')])->with('success', 'Message successfully sent');
    }
}
