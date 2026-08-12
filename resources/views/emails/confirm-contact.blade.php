<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirm your message</title>
</head>
<body>
    <h1>Confirm your message</h1>
    <p>Hi {{ $contactMessage->name }},</p>
    <p>Click the button below to confirm your email address and send your message to Billy.</p>
    <p>
        <a href="{{ $confirmationUrl }}">Confirm and send my message</a>
    </p>
    <p>This link expires in 24 hours. If you did not submit this message, you can ignore this email.</p>
</body>
</html>
