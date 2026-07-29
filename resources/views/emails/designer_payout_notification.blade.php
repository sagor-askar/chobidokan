<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payout Successful</title>
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
            background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
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
        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }
        .receipt-table th {
            text-align: left;
            padding: 12px;
            background-color: #f7fafc;
            border-bottom: 2px solid #edf2f7;
            font-weight: 600;
            color: #4a5568;
        }
        .receipt-table td {
            padding: 12px;
            border-bottom: 1px solid #edf2f7;
            color: #4a5568;
        }
        .receipt-total {
            font-weight: 700;
            font-size: 18px;
            color: #4f46e5;
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
            <h1>Payout Processed Successfully!</h1>
        </div>
        <div class="email-body">
            <p class="welcome-text">Hello {{ $designer->name }},</p>
            <p>We are pleased to inform you that a payout has been successfully processed for your work on Chobi Dokan. Below are the details of the transaction:</p>
            
            <table class="receipt-table">
                <tbody>
                    <tr>
                        <td style="font-weight: 600;">Payout Type:</td>
                        <td>{{ $payout_type }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Item Name:</td>
                        <td>{{ $item_name }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Payment Method:</td>
                        <td>{{ $payment_method }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Transaction ID:</td>
                        <td style="font-size: 13px; font-family: monospace;">{{ $txn_id }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Date:</td>
                        <td>{{ $date }}</td>
                    </tr>
                    <tr style="border-top: 2px solid #edf2f7;">
                        <td style="font-weight: 700; font-size: 18px; color: #4f46e5; padding-top: 15px;">Amount Paid:</td>
                        <td class="receipt-total" style="padding-top: 15px;">{{ number_format($amount, 2) }} BDT</td>
                    </tr>
                </tbody>
            </table>
            
            <p>If you do not see the funds in your account within 2-3 business days, or if you have any questions, please contact our support team at finance@chobidokan.com.</p>
            <p>Best regards,<br>The Chobi Dokan Team</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Chobi Dokan. All rights reserved.
        </div>
    </div>
</body>
</html>
