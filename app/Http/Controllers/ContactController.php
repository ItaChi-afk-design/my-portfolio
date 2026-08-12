<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmContactMessage;
use App\Mail\ContactFormSubmitted;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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

        if (config('mail.contact_verification_enabled')) {
            return $this->sendConfirmation($data);
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

    public function confirm(ContactMessage $contactMessage, string $token)
    {
        if (!$this->hasDeliveryMailer()) {
            return $this->deliveryNotConfiguredResponse();
        }

        try {
            $result = DB::transaction(function () use ($contactMessage, $token) {
                $message = ContactMessage::query()
                    ->lockForUpdate()
                    ->find($contactMessage->getKey());

                if (!$message) {
                    return 'invalid';
                }

                if ($message->forwarded_at) {
                    return 'already-confirmed';
                }

                if (!hash_equals((string) $message->verification_token, hash('sha256', $token))) {
                    return 'invalid';
                }

                if ($message->expires_at->isPast()) {
                    return 'expired';
                }

                Mail::to(config('mail.contact_recipient'))->send(
                    new ContactFormSubmitted($message->messageData())
                );

                $message->forceFill([
                    'verified_at' => now(),
                    'forwarded_at' => now(),
                    'verification_token' => null,
                ])->save();

                return 'confirmed';
            });
        } catch (Throwable $exception) {
            Log::error('Confirmed contact message could not be delivered.', [
                'contact_message_id' => $contactMessage->getKey(),
                'exception' => $exception,
            ]);

            return redirect('/#contact')->with(
                'error',
                'We could not send your message right now. Please try the confirmation link again later.'
            );
        }

        return match ($result) {
            'confirmed' => redirect('/#contact')->with(
                'success',
                'Your email is confirmed. Thank you—your message has been sent.'
            ),
            'already-confirmed' => redirect('/#contact')->with(
                'success',
                'This message was already confirmed and sent.'
            ),
            'expired' => redirect('/#contact')->with(
                'error',
                'This confirmation link has expired. Please submit your message again.'
            ),
            default => redirect('/#contact')->with(
                'error',
                'This confirmation link is invalid. Please submit your message again.'
            ),
        };
    }

    private function sendConfirmation(array $data)
    {
        $plainToken = Str::random(64);

        try {
            $contactMessage = ContactMessage::create([
                ...$data,
                'verification_token' => hash('sha256', $plainToken),
                'expires_at' => now()->addDay(),
            ]);

            $confirmationUrl = route('contact.confirm', [
                'contactMessage' => $contactMessage,
                'token' => $plainToken,
            ]);

            Mail::to($contactMessage->email)->send(
                new ConfirmContactMessage($contactMessage, $confirmationUrl)
            );
        } catch (Throwable $exception) {
            isset($contactMessage) && $contactMessage->delete();

            Log::error('Contact message confirmation email could not be sent.', [
                'exception' => $exception,
            ]);

            return back()->withInput()->with(
                'error',
                'We could not send a confirmation email right now. Please try again later.'
            );
        }

        return redirect('/#contact')->with(
            'success',
            'Check your inbox and click the confirmation link. Your message will be sent once confirmed.'
        );
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
