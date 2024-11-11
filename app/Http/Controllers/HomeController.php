<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth::check()) { // التحقق إذا كان المستخدم مسجل دخول
            if (auth()->user()->role_id == 1) {
                $users = User::where('role_id', 1)->get();
                return view('users.admin', compact('users'));
            } elseif (auth()->user()->role_id == 2) {
                $services = Service::where('user_id', auth()->user()->id)->get();
                return view('services.index', compact('services'));  
            } elseif (auth()->user()->role_id == 3) {
                $user = User::where('role_id', 2)->first();
                $my_services = Service::where('user_id', auth()->user()->id)->get();
                $services = Service::where('user_id', $user->id)->get();
                return view('website.index', compact('services', 'my_services'));
            }
        } else { // حالة الزائر
            $user = User::where('role_id', 2)->first();
            $services = Service::where('user_id', $user->id)->get();
            return view('website.index', compact('services'));
        }
    }
    public function allservices()
    {
            $user= User::where('role_id', 2)->first();
            $services = Service::where('user_id', $user->id)->get();
            return view('website.allservices', compact('services'));
        }

        
            
        
    
        

    public function about()
    {
        return view('contact.aboutus');
    }

    public function contact()
    {
        return view('contact.contactus');
    }
    
}
