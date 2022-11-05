<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\RateChart;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function registration_form()
    {
        return view('auth.registration');
    }

    public function registration_form_action(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users',
            'u_type' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8',
        ]);

        $registration = new User();
        $registration->email = $request->email;
        $registration->u_type = $request->u_type;
        $registration->password = Hash::make($request->password);
        $registration->confirm_password = $request->confirm_password;

        if ($request->password == $request->confirm_password) {
            $registration->save();
            $request->session()->flash('success', 'User Registered Successfully.');
            return redirect()->route('login_form');
        } else {
            $request->session()->flash('error', 'Password & Confirm Password does not match.');
            return redirect()->back();
        }
    }

    public function login_form()
    {
        return view('auth.login');
    }

    public function login_form_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // /dd($request->all());
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(["email" => $email, "password" => $password])) {
            if (auth()->user()->u_type == 'buyer') {
                return redirect()->route('buyer-dashboard');
            } else {
                return redirect()->route('seller-dashboard');
            }
        } else {
            return Redirect::back()->with(["error" => "Invalid Username & Password."]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/login-form");
    }

    public function seller_dashboard()
    {
        $seller_profile = User::where('id', Auth::user()->id)->first();
        //dd($seller_profile);
        return view('seller.seller-dashboard', compact('seller_profile'));
    }

    public function buyer_dashboard()
    {
        $seller_profile = User::where('u_type','=', 'seller')->get();
        return view('buyer.buyer-dashboard', compact('seller_profile'));
    }

    public function profile_action(Request $request,$id)
    {
        
        //dd($request->all());
        $request->validate([
            'image' => 'required|mimes:png,jpeg,jpg',
            'desc' => 'required'
        ]);
        
        $add_profile = new Profile();
        $add_profile->user_id = $id;
        $add_profile->desc = $request->desc;
        if ($files = $request->file('image')) {
            $name = $files->getClientOriginalName();
            $files->move('uploads', $name);
            $add_profile->image = $name;
        }
        // dd($id);
        if ($add_profile->save()) {
            $request->session()->flash('success', 'Profile Saved Successfully.');
            return redirect()->back();
        } else {
            $request->session()->flash('error', 'Something went wrong, please try again.');
            return redirect()->back();
        }
    }

    //FOR RATE CHART
    public function rate_chart()
    {
        $seller_profile = User::where('id', Auth::user()->id)->first();
        $rate_chart = RateChart::where('user_id', Auth::user()->id)->get();
        //dd($rate_chart);
        return view('seller.rate-chart', compact('seller_profile', 'rate_chart'));
    }

    //ADD RATE CHART
    public function rate_chart_action(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'orange_type' => 'required',
            'weight' => 'required|numeric',
            'rate' => 'required',
        ]);

        $rate_chart = new RateChart();
        $rate_chart->user_id = $id;
        $rate_chart->orange_type = $request->orange_type;
        $rate_chart->weight = $request->weight;
        $rate_chart->rate = $request->rate;

        if ($rate_chart->save()) {
            $request->session()->flash('success', 'Rate Chart Added Successfully.');
            return redirect()->back();
        } else {
            $request->session()->flash('error', 'Something went wrong, please try again.');
            return redirect()->back();
        }
    }

    //EDIT RATE CHART

    public function edit_rate_chart($id)
    {
        $rate_chart = RateChart::find($id);
        return view('seller.edit-rate-chart', compact('rate_chart'));
    }

    //UPDATE RATE CHART

    public function edit_rate_chart_action(Request $request)
    {

        $request->validate([
            'orange_type' => 'required',
            'weight' => 'required|numeric',
            'rate' => 'required',
        ]);

        $rate_chart = RateChart::find($request->id);
        $rate_chart->orange_type = $request->orange_type;
        $rate_chart->weight = $request->weight;
        $rate_chart->rate = $request->rate;

        if ($rate_chart->save()) {
            $request->session()->flash('success', 'Rate Chart Updated Successfully.');
            return redirect()->back();
        } else {
            $request->session()->flash('error', 'Something went wrong, please try again.');
            return redirect()->back();
        }
    }

    public function view_profile($id)
    {
        $view_seller_profile = User::join('profiles', 'users.id', '=', 'profiles.user_id')->join('rate_charts', 'users.id', '=', 'rate_charts.user_id')->select('users.*', 'profiles.*', 'rate_charts.*')->first();

        $seller_rate_list = User::join('rate_charts', 'users.id', '=', 'rate_charts.user_id')->where('user_id', $id)->get();
        //dd($seller_rate_list);
        return view('buyer.view-profile', compact('view_seller_profile', 'seller_rate_list'));
    }
}
