<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnquiryRequest;
use App\Mail\EnquiryReceived;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function store(StoreEnquiryRequest $request): RedirectResponse
    {
        $enquiry = Enquiry::create([
            'name' => $request->string('name'),
            'email' => $request->string('email')->toString() ?: null,
            'phone' => $request->string('phone')->toString() ?: null,
            'subject' => $request->string('subject')->toString() ?: null,
            'message' => $request->string('message'),
            'consent' => true,
        ]);

        Mail::to(config('site.notification_email'))->send(new EnquiryReceived($enquiry));

        return back()->with('status', 'Thank you — your message has been received. We will get back to you shortly.');
    }
}
