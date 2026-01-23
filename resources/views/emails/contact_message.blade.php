<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>New Contact Message</h2>

    <p><strong>Name:</strong> {{ $contactMessage->name }}</p>
    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
    <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>

    <hr>

    <p><strong>Message:</strong></p>
    <p>{{ $contactMessage->message }}</p>

    <hr>

    <p style="color:#666;">
        <strong>IP:</strong> {{ $contactMessage->ip_address ?? '-' }}<br>
        <strong>User Agent:</strong> {{ $contactMessage->user_agent ?? '-' }}
    </p>
</body>
</html>
