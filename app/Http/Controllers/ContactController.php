<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Send email
        Mail::to('kopatelroma@gmail.com') // Set the recipient email address here
        ->send(new ContactFormMail($request->all()));

        // Optionally, redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
