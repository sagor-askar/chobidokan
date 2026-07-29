<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid #e1e7f0;
        }
        .email-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .email-body {
            padding: 40px 30px;
            line-height: 1.6;
        }
        .welcome-text {
            font-size: 18px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 20px;
        }
        .verification-code-container {
            background-color: #f7fafc;
            border: 2px dashed #cbd5e0;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .verification-code {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 6px;
            color: #2b6cb0;
            margin: 0;
        }
        .email-footer {
            background-color: #f7fafc;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #718096;
            border-top: 1px solid #edf2f7;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #3182ce;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Chobi Dokan</h1>
        </div>
        <div class="email-body">
            <p class="welcome-text">Hello {{ $user->name }},</p>
            <p>Thank you for signing up for Chobi Dokan! To complete your registration and verify your email address, please use the 6-digit verification code below:</p>
            
            <div class="verification-code-container">
                <p style="margin: 0 0 10px 0; color: #4a5568; font-size: 14px; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">Your Verification Code</p>
                <h2 class="verification-code">{{ $code }}</h2>
            </div>
            
            <p>This code will expire shortly. If you did not request this code, you can safely ignore this email.</p>
            <p>Best regards,<br>The Chobi Dokan Team</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Chobi Dokan. All rights reserved.
        </div>
    </div>
</body>
</html>
