<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .code { font-size: 24px; font-weight: bold; letter-spacing: 3px; color: #007bff; text-align: center; margin: 20px 0; }
        .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Your One-Time Login Code</h2>
    <p>
        Please use the following code to complete your login. This code is valid for a limited time.
    </p>
    <div class="code">
        {{ $otpCode }}
    </div>
    <p>
        If you did not request this code, you can safely ignore this email.
    </p>
    <div class="footer">
        This is an automated message. Please do not reply.
    </div>
</div>
</body>
</html>
