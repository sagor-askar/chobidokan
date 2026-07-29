<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Confirmation</title>
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
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
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
            color: #2b6cb0;
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
            <h1>Thank You for Your Purchase!</h1>
        </div>
        <div class="email-body">
            <p class="welcome-text">Hello {{ $user->name }},</p>
            <p>Your payment has been successfully processed. Here is a summary of your purchase:</p>
            
            <table class="receipt-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @if($type === 'cart')
                        @foreach($items as $cart_item)
                            <tr>
                                <td>{{ $cart_item->product->title }}</td>
                                <td>Product</td>
                                <td>{{ $cart_item->product->price }} BDT</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>{{ $item_name }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $type)) }}</td>
                            <td>{{ $amount }} BDT</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="2" style="text-align: right; font-weight: 600;">Transaction ID:</td>
                        <td style="font-weight: 600; font-size: 13px;">{{ $txn_id }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right; font-weight: 700;">Total Paid:</td>
                        <td class="receipt-total">{{ $amount }} BDT</td>
                    </tr>
                </tbody>
            </table>
            
            <p>If you have any questions or need support, please contact us at support@chobidokan.com.</p>
            <p>Best regards,<br>The Chobi Dokan Team</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Chobi Dokan. All rights reserved.
        </div>
    </div>
</body>
</html>
