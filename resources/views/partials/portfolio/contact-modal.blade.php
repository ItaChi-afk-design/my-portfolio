<div class="modal-backdrop" id="contactModal" aria-hidden="true">
    <div class="contact-modal" role="dialog" aria-modal="true" @if(session('success')) aria-labelledby="contactSuccessMessage" @else aria-labelledby="contactModalTitle" @endif>
        <button type="button" class="modal-close" aria-label="Close contact form" data-contact-close>&times;</button>

        @if(session('success'))
            <div class="contact-success" id="contactSuccessMessage" role="status">{{ session('success') }}</div>
        @else
            <div class="modal-header">
                <p class="eyebrow contact-eyebrow">Contact Me</p>
                <h2 id="contactModalTitle">Send me a message</h2>
                <p class="contact-text">Fill up the form below to send me a message.</p>
            </div>

            @if(session('error'))
                <div class="contact-error" role="alert">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="contact-error" role="alert">
                    <p>Please correct the following:</p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="contact-form modal-form" method="POST" action="{{ route('contact.send') }}">
                @csrf
                <label>
                    <span>Full Name</span>
                    <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}" autocomplete="name" required>
                </label>
                <label>
                    <span>Email Address</span>
                    <input type="email" name="email" placeholder="you@company.com" value="{{ old('email') }}" autocomplete="email" inputmode="email" required>
                </label>
                <label>
                    <span>Phone Number</span>
                    <input type="tel" name="phone" placeholder="+1 (555) 1234-567" value="{{ old('phone') }}" autocomplete="tel" inputmode="tel">
                </label>
                <label>
                    <span>Your Message</span>
                    <textarea name="message" placeholder="Your Message" required>{{ old('message') }}</textarea>
                </label>
                <button class="button button-primary" type="submit">Send Message</button>
            </form>
        @endif
    </div>
</div>
