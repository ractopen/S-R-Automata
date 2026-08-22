<!DOCTYPE html>
<html>
<head>
    <title>Email Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Verify Your Email Address</h2>
    <p>Hello,</p>
    <p>Thank you for registering! Please use the following One-Time Password (OTP) to verify your email address and activate your account:</p>
    <p style="font-size: 20px; font-weight: bold; background-color: #f4f4f4; padding: 10px; display: inline-block; letter-spacing: 2px;">
        {{ $otp }}
    </p>
    <p>This code is valid for 15 minutes.</p>
    <p>If you did not create an account, no further action is required.</p>
    <p>Regards,<br>{{ config('app.name') }}</p>
</body>
</html>
