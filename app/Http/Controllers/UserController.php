<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function admins()
    {
        if (auth()->user()->role_id == 1) {
            $users= User::where('role_id', 1)->get();
            return view('users.admin', compact('users'));
        }
       
    }

    public function users()
    {
        if (auth()->user()->role_id == 1) {
            $users= User::with('bookings', 'orders')->where('role_id', 3)->get();
            return view('users.user', compact('users')); 
        }
    
    }

    public function freelancers()
    {
        if (auth()->user()->role_id == 1) {
            $users= User::with('bookings', 'orders')->where('role_id', 2)->get();
            return view('users.freelancers', compact('users'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        if($user->role_id == 1){
            return redirect()->route('admin.home')->with('success', 'تم اضافة مدير النظام بنجاح.');
        } elseif($user->role_id == 2){
            return redirect()->route('freelancers')->with('success', 'تم اضافة مستقل بنجاح.');
        } elseif($user->role_id == 3){
            return redirect()->route('users')->with('success', 'تم اضافة مستخدم بنجاح.');
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        if(!empty($request->password)) {
            $password = Hash::make($request->password);
            $data['password'] = $password;
        }
        $user->update();
        if($user->role_id == 1){
            return redirect()->route('admin.home')->with('success', 'تم تعديل مدير النظام بنجاح.');
        } elseif($user->role_id == 2){
            return redirect()->route('freelancers')->with('success', 'تم تعديل مستقل بنجاح.');
        } elseif($user->role_id == 3){
            return redirect()->route('users')->with('success', 'تم تعديل مستخدم بنجاح.');
        }
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        if($user->role_id == 1){
            return redirect()->route('admin.home')->with('success', 'تم حذف مدير النظام بنجاح.');
        } elseif($user->role_id == 2){
            return redirect()->route('freelancers')->with('success', 'تم حذف المستقل بنجاح.');
        } elseif($user->role_id == 3){
            return redirect()->route('users')->with('success', 'تم حذف المستخدم بنجاح.');
        }
       
    }

    public function userProfile()
    {

        $user = User::where('id', auth()->user()->id)->first();
        $booking = Booking::where('status', 'Finished')->where('owner_id', auth()->user()->id)->count();
        $bookings = Booking::where('user_id', auth()->user()->id)->get();
        $mybookings = Booking::where('owner_id', auth()->user()->id)->get();
        $orders = Order::where('owner_id', auth()->user()->id)->get();
        $myorders = Order::where('user_id', auth()->user()->id)->get();

        return view('profile.user', compact('user', 'bookings', 'orders', 'booking', 'mybookings', 'myorders'));
    }

    public function freelancerProfile($id)
    {
        $user = User::where('id', $id)->first();
        return view('profile.freelancer', compact('user'));
    }

    public function updateProfile(Request $request, $id)
{
    $user = User::find($id);

    $user->name = $request->input('name', $user->name);
    $user->email = $request->input('email', $user->email);
    $user->address = $request->input('address', $user->address);
    $user->phone_number = $request->input('phone_number', $user->phone_number);

    if ($request->has('role_id')) {
        $user->role_id = $request->role_id;
    }

    if (!empty($request->input('password'))) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    return redirect()->route('profile')->with('success', 'تم تعديل الملف الشخصي بنجاح.');
}


}
