<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\User;
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
            if (Hash::check($request->input('password'), $user->password)) {
                return redirect()->route('super_user_dashboard', ['user_id' => $user->id]);
            } else {
                return redirect('super_user_login')->with('error', 'Wrong Credentials');
                // return redirect('/')->with('error', 'Wrong Credentials');
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

    public function super_user_logut()
    {
        Auth::logout();

        return redirect('super_user_login');
    }

    public function status_approval($user_id, $status, $barangay_id)
    {
        Barangay::where('id', $barangay_id)
            ->update(['status' => 'Approved']);

        return redirect()->route('super_user_dashboard', ['user_id' => $user_id])->with('success', 'Selected barangay approved successfully');
    }
}
