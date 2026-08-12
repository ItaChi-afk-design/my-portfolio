<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string',
        ]);

        if (!$this->hasDeliveryMailer()) {
            return $this->deliveryNotConfiguredResponse();
        }

        try {
            Mail::to(config('mail.contact_recipient'))->send(new ContactFormSubmitted($data));
        } catch (Throwable $exception) {
            Log::error('Contact form email delivery failed.', [
                'exception' => $exception,
            ]);

            return back()->withInput()->with(
                'error',
                'We could not send your message right now. Please try again later or email me directly.'
            );
        }

        return redirect('/#contact')->with('success', 'Thanks! Your message was sent.');
    }

    private function hasDeliveryMailer(): bool
    {
        return !in_array(config('mail.default'), ['array', 'log'], true);
    }

    private function deliveryNotConfiguredResponse()
    {
        Log::error('Contact form email was not sent because no delivery mailer is configured.', [
            'mailer' => config('mail.default'),
        ]);

        return back()->withInput()->with(
            'error',
            'Email delivery is not configured yet. Please try again later or email me directly.'
        );
    }
}
