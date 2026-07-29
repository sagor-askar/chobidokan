<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Project Request Confirmed</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .email-header {
            background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            padding: 35px 30px;
            text-align: center;
            color: #ffffff;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.025em;
        }
        .email-body {
            padding: 40px 30px;
            line-height: 1.625;
        }
        .welcome-text {
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 20px;
            margin-top: 0;
        }
        .lead-text {
            font-size: 15px;
            color: #475569;
            margin-bottom: 25px;
        }
        .info-card {
            background-color: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 24px;
            margin: 25px 0;
        }
        .info-card-title {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6366f1;
            margin-top: 0;
            margin-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
        }
        .info-row {
            margin-bottom: 12px;
            font-size: 15px;
        }
        .info-row:last-child {
            margin-bottom: 0;
        }
        .info-label {
            font-weight: 600;
            color: #64748b;
            display: inline-block;
            width: 120px;
            vertical-align: top;
        }
        .info-value {
            color: #1e293b;
            display: inline-block;
            width: 380px;
            vertical-align: top;
        }
        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }
        .receipt-table th {
            text-align: left;
            padding: 12px;
            background-color: #f1f5f9;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
        }
        .receipt-table td {
            padding: 12px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #475569;
            vertical-align: top;
        }
        .receipt-total {
            font-weight: 700;
            font-size: 18px;
            color: #4f46e5;
        }
        .btn-container {
            text-align: center;
            margin: 35px 0 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 14px 32px;
            background-color: #4f46e5;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2), 0 2px 4px -1px rgba(79, 70, 229, 0.1);
        }
        .email-footer {
            background-color: #f8fafc;
            padding: 24px;
            text-align: center;
            font-size: 13px;
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
        }
        .footer-links {
            margin-top: 8px;
        }
        .footer-links a {
            color: #6366f1;
            text-decoration: none;
            margin: 0 8px;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            background-color: #e0e7ff;
            color: #4338ca;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Custom Request Placed Successfully!</h1>
        </div>
        <div class="email-body">
            <p class="welcome-text">Hello {{ $user->name }},</p>
            <p class="lead-text">Thank you for submitting a custom request on Chobi Dokan. Your payment was successfully processed, and your project is now live! Designers will start submitting designs for your review soon.</p>
            
            <div class="info-card">
                <h3 class="info-card-title">Project Details</h3>
                <div class="info-row">
                    <span class="info-label">Project Name:</span>
                    <span class="info-value"><strong>{{ $project->name }}</strong></span>
                </div>
                @if($project->category)
                <div class="info-row">
                    <span class="info-label">Category:</span>
                    <span class="info-value"><span class="badge">{{ $project->category->name }}</span></span>
                </div>
                @endif
                @if($project->project_description)
                <div class="info-row">
                    <span class="info-label">Requirements:</span>
                    <span class="info-value" style="font-size: 14px; white-space: pre-line;">{{ $project->project_description }}</span>
                </div>
                @endif
                <div class="info-row">
                    <span class="info-label">Deadline:</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($project->expire_date)->format('M d, Y') }}</span>
                </div>
            </div>

            <div class="info-card" style="margin-top: 0;">
                <h3 class="info-card-title">Payment Receipt</h3>
                <table class="receipt-table" style="margin: 0;">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th style="text-align: right;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>{{ $subscription->title ?? 'Custom Project Pricing Plan' }}</strong><br>
                                <span style="font-size: 12px; color: #64748b;">Includes designer submission pool and live project hosting</span>
                            </td>
                            <td style="text-align: right; font-weight: 600;">{{ number_format($amount, 2) }} BDT</td>
                        </tr>
                        <tr>
                            <td style="text-align: right; font-weight: 600; padding-top: 16px; border: none;">Transaction ID:</td>
                            <td style="text-align: right; font-size: 13px; font-family: monospace; color: #64748b; padding-top: 16px; border: none;">{{ $txn_id }}</td>
                        </tr>
                        <tr style="border-top: 1px solid #e2e8f0;">
                            <td style="text-align: right; font-weight: 700; padding-top: 12px;">Total Paid:</td>
                            <td class="receipt-total" style="text-align: right; padding-top: 12px;">{{ number_format($amount, 2) }} BDT</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="btn-container">
                <a href="{{ route('customize-details', $project->id) }}" class="btn">Track Project & View Designs</a>
            </div>
            
            <p style="margin-top: 30px; font-size: 14px; color: #64748b;">Need assistance? Our support team is here to help you get the perfect design. Feel free to contact us at <a href="mailto:support@chobidokan.com" style="color: #4f46e5; text-decoration: none;">support@chobidokan.com</a>.</p>
            <p style="margin-bottom: 0;">Best regards,<br><strong>The Chobi Dokan Team</strong></p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Chobi Dokan. All rights reserved.
            <div class="footer-links">
                <a href="{{ url('/') }}">Website</a> | 
                <a href="{{ route('user.dashboard') }}">Your Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
