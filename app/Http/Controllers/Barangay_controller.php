<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barangay;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
        $image_name = $user_image->getClientOriginalName();
        $user_image->move(public_path() . '/images/', $image_name);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'contact_number' => $request->input('contact_number'),
            'user_image' => $image_name,
            'barangay_id' => $barangay->id,
        ]);

        $user->save();

        return redirect('barangay_admin_login')->with('success','Successfully created admin account, You can now login');

    }

    public function barangay_admin_login()
    {
        return view('barangay_admin_login');
    }

    public function home()
    {
        return view('home');
    }
}
