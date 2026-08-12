<?php

namespace Tests\Feature;

use App\Mail\ConfirmContactMessage;
use App\Mail\ContactFormSubmitted;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_valid_contact_message_is_sent_when_verification_is_disabled(): void
    {
        config([
            'mail.default' => 'resend',
            'mail.contact_verification_enabled' => false,
        ]);

        Mail::fake();

        $response = $this->post(route('contact.send'), [
            'name' => 'Jane Doe',
            'email' => 'jane@gmail.com',
            'phone' => '+1 555 0100',
            'message' => 'Hello from the contact form.',
        ]);

        $response->assertRedirect('/#contact');
        $response->assertSessionHas('success');

        $confirmationPage = $this->get('/');

        $confirmationPage->assertSee('contactSuccessMessage');
        $confirmationPage->assertDontSee('Full Name');

        Mail::assertSent(ContactFormSubmitted::class, function (ContactFormSubmitted $mail) {
            return $mail->data['name'] === 'Jane Doe'
                && $mail->data['email'] === 'jane@gmail.com'
                && $mail->data['phone'] === '+1 555 0100';
        });
    }

    public function test_a_contact_message_is_only_sent_after_its_email_is_confirmed(): void
    {
        config([
            'mail.default' => 'resend',
            'mail.contact_verification_enabled' => true,
        ]);

        Mail::fake();

        $response = $this->post(route('contact.send'), [
            'name' => 'Jane Doe',
            'email' => 'jane@gmail.com',
            'phone' => '+1 555 0100',
            'message' => 'Hello from the contact form.',
        ]);

        $response->assertRedirect('/#contact');
        $response->assertSessionHas('success');
        Mail::assertNotSent(ContactFormSubmitted::class);

        $confirmationUrl = null;

        Mail::assertSent(ConfirmContactMessage::class, function (ConfirmContactMessage $mail) use (&$confirmationUrl) {
            $confirmationUrl = $mail->confirmationUrl;

            return $mail->contactMessage->email === 'jane@gmail.com';
        });

        $pendingMessage = ContactMessage::firstOrFail();
        $this->assertNull($pendingMessage->verified_at);
        $this->assertNotNull($confirmationUrl);

        $confirmationResponse = $this->get($confirmationUrl);

        $confirmationResponse->assertRedirect('/#contact');
        $confirmationResponse->assertSessionHas('success');
        $this->assertNotNull($pendingMessage->refresh()->verified_at);
        $this->assertNotNull($pendingMessage->forwarded_at);

        Mail::assertSent(ContactFormSubmitted::class, function (ContactFormSubmitted $mail) {
            return $mail->data['email'] === 'jane@gmail.com';
        });
    }

    public function test_a_message_is_not_marked_as_sent_when_email_delivery_is_not_configured(): void
    {
        config([
            'mail.default' => 'log',
            'mail.contact_verification_enabled' => false,
        ]);

        $response = $this->post(route('contact.send'), [
            'name' => 'Jane Doe',
            'email' => 'jane@gmail.com',
            'phone' => '+1 555 0100',
            'message' => 'Hello from the contact form.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_an_invalid_email_address_is_rejected(): void
    {
        $response = $this->post(route('contact.send'), [
            'name' => 'Jane Doe',
            'email' => 'not-an-email',
            'message' => 'Hello from the contact form.',
        ]);

        $response->assertSessionHasErrors('email');
    }

}
