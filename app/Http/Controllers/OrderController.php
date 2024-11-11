<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        if (auth()->user()->role_id == 3) {
            $user= User::where('role_id', 2)->first();
            $my_services = Service::where('user_id', auth()->user()->id)->get();
            $services = Service::where('user_id', $user->id)->get();
            return view('website.index', compact('services','my_services'));
        }
        
    }

    public function store(Request $request)
    {
        try {
            $order = new Order();
            $order->user_id = auth()->user()->id;
            $order->service_id = $request->service_id;
            $order->owner_id = $request->owner_id;
            $order->booking_date = now();
            $order->save();
    
            return response()->json(['success' => true, 'message' => 'تم حجز الخدمة بنجاح.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'حدث خطأ ما، يرجى المحاولة لاحقاً.']);
        }
    }
    public function acceptOrder($id)
{
    $order = Order::find($id);
    if ($order) {
        $order->status = 'Accepted';
        $order->save();
        return redirect()->back()->with('success', 'تم قبول الحجز بنجاح');
    } else {
        return redirect()->back()->with('error', 'الحجز غير موجود');
    }
}

public function rejectOrder($id)
{
    $order = Order::find($id);
    if ($order) {
        $order->status = 'Rejected';
        $order->save();
        return redirect()->back()->with('success', 'تم رفض الحجز بنجاح');
    } else {
        return redirect()->back()->with('error', 'الحجز غير موجود');
    }
}

public function cancelOrder($id)
{
    $order = Order::find($id);
    if ($order) {
        $order->status = 'Canceled'; 
        $order->save();
        return redirect()->back()->with('success', 'تم إلغاء الحجز بنجاح');
    } else {
        return redirect()->back()->with('error', 'الحجز غير موجود');
    }
}

    }

