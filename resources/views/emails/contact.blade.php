<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Mail</title>
</head>
<body>
    <h2>New Contact Message Received</h2>
    <p><strong>Name:</strong> {{ $contactData['name'] }}</p>
    <p><strong>Email:</strong> {{ $contactData['email'] }}</p>
    <p><strong>phone:</strong> {{ $contactData['phone'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $contactData['message'] }}</p>
</body>
</html>