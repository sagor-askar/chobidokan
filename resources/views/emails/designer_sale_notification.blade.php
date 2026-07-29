<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congratulations! Product Sold</title>
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
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
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
            background-color: #f0fff4;
            border-left: 4px solid #38a169;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
        }
        .info-box table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-box td {
            padding: 6px 0;
            color: #2d3748;
            font-size: 15px;
        }
        .info-box td.label {
            font-weight: 600;
            width: 40%;
        }
        .payout-section {
            background-color: #ebf8ff;
            border: 1px solid #bee3f8;
            border-radius: 8px;
            padding: 15px;
            margin-top: 25px;
            font-size: 15px;
            color: #2b6cb0;
            text-align: center;
            font-weight: 500;
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
            <h1>Congratulations! You Made a Sale!</h1>
        </div>
        <div class="email-body">
            <p class="welcome-text">Hello {{ $designer->name }},</p>
            <p>We are excited to let you know that one of your products has been successfully purchased on Chobi Dokan!</p>
            
            <div class="info-box">
                <table>
                    <tr>
                        <td class="label">Product Title:</td>
                        <td><strong>{{ $product->title }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Sale Amount:</td>
                        <td>{{ number_format($amount, 2) }} BDT</td>
                    </tr>
                    <tr>
                        <td class="label">Platform Fee:</td>
                        <td>{{ $admin_percentage }}%</td>
                    </tr>
                    <tr style="border-top: 1px solid #cbd5e0;">
                        <td class="label" style="padding-top: 12px; font-size: 16px; color: #27ae60;">Your Earnings:</td>
                        <td style="padding-top: 12px; font-size: 16px; font-weight: 700; color: #27ae60;">{{ number_format($earning_amount, 2) }} BDT</td>
                    </tr>
                </table>
            </div>

            <div class="payout-section">
                Your payment of <strong>{{ number_format($earning_amount, 2) }} BDT</strong> (calculated after platform fee deduction) is being processed and will be paid to you very soon.
            </div>
            
            <p style="margin-top: 30px;">Thank you for selling on Chobi Dokan! Keep up the excellent work.</p>
            <p>Best regards,<br>The Chobi Dokan Team</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Chobi Dokan. All rights reserved.
        </div>
    </div>
</body>
</html>
