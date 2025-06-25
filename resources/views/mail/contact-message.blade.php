<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; background: #f9f9f9; padding: 2rem;">
    <div style="max-width: 600px; margin: auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #0001; padding: 2rem;">
        <h2 style="color: #2563eb; margin-bottom: 1rem;">New Contact Message</h2>
        <p><strong>Name:</strong> {{ $name }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Message:</strong></p>
        <div style="background: #f3f4f6; border-radius: 4px; padding: 1rem; margin-bottom: 1rem; color: #333;">
            {{ $messageText }}
        </div>
    </div>
</body>
</html>
