<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Approved</title>
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
            background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
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
        .info-box {
            background-color: #e6fffa;
            border-left: 4px solid #319795;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .email-footer {
            background-color: #f7fafc;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #718096;
            border-top: 1px solid #edf2f7;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Product Approved & Live!</h1>
        </div>
        <div class="email-body">
            <p class="welcome-text">Hello {{ $designer->name }},</p>
            <p>We are pleased to inform you that your product <strong>{{ $product->title }}</strong> has been approved by the Admin and is now live on Chobi Dokan!</p>
            
            <div class="info-box">
                <strong>Product Details:</strong><br>
                Title: {{ $product->title }}<br>
                Price: {{ $product->price }} BDT<br>
                Status: Live
            </div>
            
            <p>Good luck with your sales! Thank you for selling on Chobi Dokan.</p>
            <p>Best regards,<br>The Chobi Dokan Team</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Chobi Dokan. All rights reserved.
        </div>
    </div>
</body>
</html>
