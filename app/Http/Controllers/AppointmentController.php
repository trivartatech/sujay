<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatus;
use App\Http\Requests\StoreAppointmentRequest;
use App\Mail\AppointmentReceived;
use App\Models\Appointment;
use App\Models\Procedure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function create(): View
    {
        return view('appointments.create', [
            'procedures' => Procedure::published()->orderBy('sort_order')->get(),
        ]);
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        $appointment = Appointment::create([
            'name' => $request->string('name'),
            'phone' => $request->string('phone'),
            'email' => $request->string('email')->toString() ?: null,
            'preferred_date' => $request->date('preferred_date'),
            'preferred_time' => $request->string('preferred_time')->toString() ?: null,
            'reason' => $request->string('reason')->toString() ?: null,
            'status' => AppointmentStatus::Pending,
            'consent' => true,
        ]);

        // DPDP: notify staff without putting medical details in the email body;
        // they review the request inside the dashboard.
        Mail::to(config('site.notification_email'))->send(new AppointmentReceived($appointment));

        return redirect()
            ->route('appointment.create')
            ->with('status', 'Thank you — your appointment request has been received. Our team will call you to confirm.');
    }
}
