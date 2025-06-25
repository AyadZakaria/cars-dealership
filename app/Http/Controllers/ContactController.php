<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Send email to app email address
        $to = config('mail.from.address');
        Mail::to($to)->send(new ContactMessage(
            $validated['name'],
            $validated['email'],
            $validated['message']
        ));

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
