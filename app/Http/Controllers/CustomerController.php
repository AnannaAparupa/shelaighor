<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function showLoginForm()
    {
        return \view('front.login');
    }
    public function showRegisterForm()
    {
        return \view('front.register');
    }

    public function actionRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'phone' => 'required',
            'email' => 'email|unique:customers',
            'password' => 'required|confirmed|min:6',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone'=>$request->phone,
            'password' => Hash::make($request->password),
        ]);

        return \redirect()->back()->with('Message', 'Registerd Success. Now you can login');
    }

    public function actionLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'email',
            'password' => 'required|min:6',
        ]);
        if (Auth::guard('customer')->attempt(['email'=>$request->email, 'password'=>$request->password]))
        {
            return \redirect()->to('/shop');
        }

        return \redirect()->back()->with('Message', 'Login Faild, Email or password Wrong');
    }

    public function actionMyAccount()
    {
        return \view('front.myaccount');
    }
}
