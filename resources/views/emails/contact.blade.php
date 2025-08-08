<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission - The Dog Kennel</title>
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
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
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
        .field {
            margin-bottom: 25px;
            padding: 20px;
            background: #f8fafc;
            border-left: 4px solid #f97316;
            border-radius: 8px;
        }
        .field-label {
            font-weight: bold;
            color: #f97316;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .field-value {
            color: #374151;
            font-size: 16px;
            line-height: 1.5;
        }
        .message-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            white-space: pre-wrap;
            word-wrap: break-word;
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
        .timestamp {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
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
        <h1><span class="dog-emoji">🐕</span> The Dog Kennel <span class="dog-emoji">🐾</span></h1>
        <p>New Contact Form Submission</p>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="timestamp">
            <strong>📅 Received:</strong> {{ now()->format('F j, Y \a\t g:i A') }}
        </div>

        <div class="field">
            <div class="field-label">👤 Customer Name</div>
            <div class="field-value">{{ $name }}</div>
        </div>

        <div class="field">
            <div class="field-label">📧 Email Address</div>
            <div class="field-value">
                <a href="mailto:{{ $email }}" style="color: #f97316; text-decoration: none;">{{ $email }}</a>
            </div>
        </div>

        <div class="field">
            <div class="field-label">💬 Message</div>
            <div class="field-value">
                <div class="message-content">{{ $message }}</div>
            </div>
        </div>

        <div style="background: #dbeafe; border: 1px solid #3b82f6; padding: 20px; border-radius: 8px; margin-top: 30px;">
            <h3 style="color: #1e40af; margin: 0 0 10px 0; font-size: 16px;">
                🔔 Action Required
            </h3>
            <p style="margin: 0; color: #1e40af; font-size: 14px;">
                Please respond to this customer inquiry within 24 hours to maintain our excellent service standards.
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>The Dog Kennel</strong></p>
        <p>Kleinhoefstraat 4, 2440 Geel</p>
        <p>📞 (123) 456-7890 | 📧 info@example.com</p>
        <p style="margin-top: 15px; font-size: 12px; opacity: 0.8;">
            This email was automatically generated from your website contact form.
        </p>
    </div>
</div>
</body>
</html>
