<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
            .wrapper { background-color: lightgray; padding: 20px 10px; }
            .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
            .content { padding: 40px; text-align: center; }
            .greetings { color: #444; font-size: 22px; font-weight: 800; margin-bottom: 25px; line-height: 1.2; }
            .footer-note { font-size: 14px; color: #666; }
            .intro-text { font-size: 14px; color: #666; }
            .otp-box { background: #f8faff; border: 2px dashed #2575fc; border-radius: 12px; padding: 20px; margin: 25px 0; font-size: 32px; font-weight: bold; color: #2575fc; letter-spacing: 8px; }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <div class="container">
                <div class="content">
                    <h2 class="greetings">Greetings, {{ $user->person->full_name }}!</h2>
                    <p class="intro-text">{{ $introText }}</p>
                    <div class="otp-box">{{ $otp }}</div>
                    <p class="footer-note">This OTP is only valid for <strong>180 seconds</strong>. Click '<strong>Resend OTP</strong>' if this OTP expires.<br>If you did not request this code, you can ignore this email.</p>
                </div>
            </div>
        </div>
    </body>
</html>
