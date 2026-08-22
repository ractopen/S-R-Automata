<!DOCTYPE html>
<html>
<head>
    <title>Login Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Login Verification</h2>
    <p>Hello,</p>
    <p>Please use the following One-Time Password (OTP) to authorize your login:</p>
    <p style="font-size: 20px; font-weight: bold; background-color: #f4f4f4; padding: 10px; display: inline-block; letter-spacing: 2px;">
        {{ $otp }}
    </p>
    <p>This code is valid for 15 minutes.</p>
    <p>Regards,<br>{{ config('app.name') }}</p>
</body>
</html>
