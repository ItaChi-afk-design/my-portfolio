<?php

namespace Tests\Feature;

use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_a_valid_contact_message_is_sent(): void
    {
        config([
            'mail.default' => 'resend',
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

    public function test_a_message_is_not_marked_as_sent_when_email_delivery_is_not_configured(): void
    {
        config([
            'mail.default' => 'log',
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
