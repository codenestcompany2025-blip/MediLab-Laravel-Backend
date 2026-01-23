<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        // 1) Store in DB
        $msg = ContactMessage::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'subject'    => $validated['subject'],
            'message'    => $validated['message'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // 2) Send Email 
        $receiver = env('CONTACT_RECEIVER_EMAIL', config('mail.from.address'));

        if ($receiver) {
            Mail::to($receiver)->send(new ContactMessageMail($msg));
        }

        return redirect()
            ->to(route('front.home') . '#contact')
            ->with('contact_success', 'Your message has been sent successfully.');
    }
}
