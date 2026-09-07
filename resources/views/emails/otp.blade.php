<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #1e293b; background-color: #f8fafc; margin: 0; padding: 0;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f8fafc; padding: 40px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" max-width="600" style="max-width: 600px; width: 100%; background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); overflow: hidden;">
                    <!-- Header Accent -->
                    <tr>
                        <td style="background-color: #1e3a8a; height: 6px;"></td>
                    </tr>
                    <!-- Main Body -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <!-- App Name / Logo -->
                            <div style="text-align: center; margin-bottom: 30px;">
                                <span style="font-size: 24px; font-weight: 800; color: #1e3a8a; letter-spacing: 1px;">{{ config('app.name') }}</span>
                            </div>
                            
                            <h2 style="font-size: 20px; font-weight: 700; color: #0f172a; margin-top: 0; margin-bottom: 20px; text-align: center;">Password Reset Request</h2>
                            
                            <p style="font-size: 16px; color: #334155; margin-bottom: 24px; text-align: center;">Hello,</p>
                            <p style="font-size: 16px; color: #334155; margin-bottom: 24px; text-align: center;">You are receiving this email because we received a password reset request for your account.</p>
                            
                            <!-- OTP Code Box -->
                            <div style="text-align: center; margin: 30px 0;">
                                <div style="display: inline-block; font-family: 'Courier New', Courier, monospace; font-size: 32px; font-weight: 700; color: #1e3a8a; background-color: #eff6ff; border: 1px dashed #bfdbfe; padding: 12px 30px; border-radius: 6px; letter-spacing: 4px; box-shadow: inset 0 2px 4px 0 rgba(0,0,0,0.02);">
                                    {{ $otp }}
                                </div>
                            </div>
                            
                            <p style="font-size: 14px; color: #64748b; margin-top: 24px; text-align: center;">This One-Time Password (OTP) is valid for <strong>15 minutes</strong>.</p>
                            <p style="font-size: 14px; color: #94a3b8; margin-top: 24px; text-align: center; border-top: 1px solid #f1f5f9; padding-top: 20px;">If you did not request a password reset, no further action is required.</p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f1f5f9; padding: 20px 30px; text-align: center; font-size: 12px; color: #64748b;">
                            <p style="margin: 0;">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
