<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {
        return view('bookings.index');
    }
    public function store(Request $request)
    {
        try {
            // تحقق من البيانات المدخلة
            $request->validate([
                'service_id' => 'required|integer',
                'owner_id' => 'required|integer',
                'title' => 'required|string|max:255',
                'des' => 'required|string',  // التحقق من الحقل الجديد
                'delivery_date' => 'required|date',
            ]);
    
            // إنشاء حجز جديد
            $booking = new Booking();
            $booking->user_id = auth()->user()->id;
            $booking->service_id = $request->service_id;
            $booking->owner_id = $request->owner_id;
            $booking->title = $request->title;
            $booking->des = $request->des;  // استخدام الحقل الجديد
            $booking->delivery_date = $request->delivery_date;
            $booking->save();
    
            return response()->json(['success' => true, 'message' => 'تم إرسال الطلب بنجاح.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    
    
    public function respondToBooking(Request $request, $bookingId)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);
    
        $booking = Booking::findOrFail($bookingId);
        
        // تحديث السعر في الطلب
        $booking->price = $request->price;
        
        // تحديث حالة الطلب بناءً على السعر
        $booking->status = 'PriceSend'; // أو أي حالة تراها مناسبة
        
        $booking->save();
        
        return redirect()->back()->with('success', 'تم ارسال السعر بنجاح');
    }
    
    public function acceptBooking($id)
{
    $booking = Booking::find($id);
    if ($booking) {
        $booking->status = 'Accepted';
        $booking->save();
        return redirect()->back()->with('success', 'تم قبول الحجز بنجاح');
    } else {
        return redirect()->back()->with('error', 'الحجز غير موجود');
    }
}

public function rejectBooking($id)
{
    $booking = Booking::find($id);
    if ($booking) {
        $booking->status = 'Rejected';
        $booking->save();
        return redirect()->back()->with('success', 'تم رفض الحجز بنجاح');
    } else {
        return redirect()->back()->with('error', 'الحجز غير موجود');
    }
}

public function cancelBooking($id)
{
    $booking = Booking::find($id);
    if ($booking) {
        $booking->status = 'Canceled'; // استخدم القيمة الصحيحة هنا
        $booking->save();
        return redirect()->back()->with('success', 'تم إلغاء الحجز بنجاح');
    } else {
        return redirect()->back()->with('error', 'الحجز غير موجود');
    }
}

public function finishBooking($id)
{
    $booking = Booking::find($id);
    if ($booking) {
        $booking->status = 'Finished';
        $booking->save();
        return redirect()->back()->with('success', 'تم تنفيذ الحجز بنجاح');
    } else {
        return redirect()->back()->with('error', 'الحجز غير موجود');
    }


}


}
