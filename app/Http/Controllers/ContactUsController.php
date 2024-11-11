<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    public function index()
    {
        if (auth()->user()->role_id == 1) 
        {
            $contacts = ContactUs::all();
            return view('contactus', compact('contacts'));

        }

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        ContactUs::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
        ]);

        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح!');
    }
}
