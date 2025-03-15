<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Two-Factor Authentication Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .code-container {
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #eaeaea;
        }
        .code {
            font-size: 32px;
            letter-spacing: 5px;
            color: #4A5568;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Two-Factor Authentication Code</h1>
        </div>

        <p>Your two-factor authentication code is:</p>

        <div class="code-container">
            <div class="code">{{ $code }}</div>
        </div>

        <p>This code will expire in 10 minutes.</p>

        <p>If you did not request this code, please ignore this email and secure your account.</p>

        <div class="footer">
            <p>Thanks,<br>{{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>
