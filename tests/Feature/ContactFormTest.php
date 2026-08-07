<?php

namespace Tests\Feature;

use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_a_valid_contact_message_is_sent(): void
    {
        Mail::fake();

        $response = $this->post(route('contact.send'), [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '+1 555 0100',
            'message' => 'Hello from the contact form.',
        ]);

        $response->assertRedirect('/#contact');
        $response->assertSessionHas('success');

        Mail::assertSent(ContactFormSubmitted::class, function (ContactFormSubmitted $mail) {
            return $mail->data['name'] === 'Jane Doe'
                && $mail->data['email'] === 'jane@example.com'
                && $mail->data['phone'] === '+1 555 0100';
        });
    }

}
