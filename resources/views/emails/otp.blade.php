<!DOCTYPE html>
<html>
<head>
    <title>Your OTP Code</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Password Reset Request</h2>
    <p>Hello,</p>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p style="font-size: 18px; font-weight: bold; background-color: #f4f4f4; padding: 10px; display: inline-block; letter-spacing: 2px;">
        {{ $otp }}
    </p>
    <p>This One-Time Password (OTP) is valid for 15 minutes. If you did not request a password reset, no further action is required.</p>
    <p>Regards,<br>{{ config('app.name') }}</p>
</body>
</html>
