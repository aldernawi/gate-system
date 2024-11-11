<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\User;


class ServiceController extends Controller
{
    

    public function index()
    {
        if (auth()->user()->role_id == 2) {
            $services = Service::where('user_id', auth()->user()->id)->get();
            return view('services.index', compact('services'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'delivery_date' => 'nullable',
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->price = $request->price ?? 0;
        $service->description = $request->description;
        $service->delivery_date = $request->delivery_date;
        $service->status = $request->status;
        $service->user_id = auth()->user()->id;
        $service->save();
        return redirect()->back()->with('success', 'تم اضافة خدمة بنجاح.');
    }    
    
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        $service->name = $request->name;
        $service->price = $request->price ?? 0;
        $service->description = $request->description;
        $service->delivery_date = $request->delivery_date;
        $service->update();

            return redirect()->back()->with('success', 'تم تعديل خدمة بنجاح.');
        }
    
        public function accept($id)
        {
            $service = service::find($id);
            if ($service) {
                $service->status = 'Accepted';
                $service->save();
                return redirect()->back()->with('success', 'تم قبول الخدمة بنجاح');
            } else {
                return redirect()->back()->with('error', 'الخدمة غير موجود');
            }
        }
        
        public function reject($id)
        {
            $service = service::find($id);
            if ($service) {
                $service->status = 'Rejected';
                $service->save();
                return redirect()->back()->with('success', 'تم رفض الحجز بنجاح');
            } else {
                return redirect()->back()->with('error', 'الحجز غير موجود');
            }
        }

        public function destroy($id)
        {
            $service = Service::find($id);
        
            if (!$service) {
                return redirect()->back()->with('error', 'الخدمة غير موجودة.');
            }
        
            $service->delete();
            return redirect()->back()->with('success', 'تم حذف خدمة بنجاح.');
        }
        

        public function order()
        {
            if (auth()->user()->role_id == 2) {
                $user= User::where('role_id', 3)->first();
                $services = Service::where('user_id', $user->id)->get();
                return view('services.order', compact('services'));
            }
            
        }


        public function orderDetails()
        {
            $services = Service::where('status', 'Pending')->get();
            return view('services.orderdetails', compact('services'));
        }
    
    

}
