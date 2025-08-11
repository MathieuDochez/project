<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - The Dog Kennel</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #374151;
            background-color: #f9fafb;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #617457 0%, #4a5a41 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            background: #f0f9ff;
            border: 1px solid #617457;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
        }
        .order-details {
            background: #f8fafc;
            border-left: 4px solid #617457;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
        }
        .order-details h3 {
            color: #617457;
            font-size: 18px;
            margin: 0 0 15px 0;
            font-weight: bold;
        }
        .order-details ul {
            margin: 0;
            padding-left: 20px;
        }
        .order-details li {
            margin-bottom: 8px;
            color: #374151;
        }
        .total-price {
            background: #617457;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .shipping-info {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .shipping-info h4 {
            color: #617457;
            margin: 0 0 10px 0;
            font-size: 16px;
        }
        .backorder {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .backorder h4 {
            color: #d97706;
            margin: 0 0 10px 0;
        }
        .footer {
            background: #374151;
            color: white;
            padding: 25px;
            text-align: center;
            font-size: 14px;
        }
        .footer p {
            margin: 5px 0;
        }
        .dog-emoji {
            font-size: 24px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <!-- Header -->
    <div class="header">
        <h1><span class="dog-emoji">🐕</span> The Dog Kennel <span class="dog-emoji">🛒</span></h1>
        <p>Order Confirmation</p>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="greeting">
            <h2 style="margin: 0; color: #617457;">Dear {{ auth()->user()->name ?? 'Valued Customer' }},</h2>
            <p style="margin: 10px 0 0 0; color: #374151;">Thank you for your order! 🎉</p>
        </div>

        <div class="order-details">
            {!! nl2br($data['message']) !!}
        </div>

        <div style="background: #dbeafe; border: 1px solid #3b82f6; padding: 20px; border-radius: 8px; margin-top: 30px;">
            <h3 style="color: #1e40af; margin: 0 0 10px 0; font-size: 16px;">
                📦 What's Next?
            </h3>
            <p style="margin: 0; color: #1e40af; font-size: 14px;">
                Your order is being processed and will be shipped as soon as possible. You'll receive a tracking number once your items are on their way!
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>The Dog Kennel</strong></p>
        <p>Kleinhoefstraat 4, 2440 Geel</p>
        <p>📞 (123) 456-7890 | 📧 info@example.com</p>
        <p style="margin-top: 15px; font-size: 12px; opacity: 0.8;">
            Thank you for choosing The Dog Kennel for your pet's needs! 🐾
        </p>
    </div>
</div>
</body>
</html>
