<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New contact message</title>
</head>
<body>
    <h1>New contact message</h1>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    @if(!empty($data['phone']))
        <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    @endif
    <p><strong>Message:</strong></p>
    <p>{!! nl2br(e($data['message'])) !!}</p>
</body>
</html>
