<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
            .wrapper { background-color: lightgray; padding: 20px 10px; }
            .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
            .content { padding: 40px; text-align: center; }
            .greetings { color: #444; }
            .status-icon { font-size: 48px; margin-bottom: 20px; }
            .main-text { font-size: 14px; color: #666; }
            .footer-note { font-size: 14px; color: #666; margin-top: 30px; }
            .appointment-card { margin: 60px 0; padding: 40px 10px; background-color: #f9fafb; border-radius: 20px; border: 1px solid #f3f4f6; }
            .appointment-label { margin: 0; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 1.5px; font-size: 11px; }
            .appointment-date { margin: 15px 0 0 0; color: #1f2937; font-size: 16px; font-weight: 600; }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <div class="container">
                <div class="content">
                    <h2 class="greetings">Greetings, {{ $referral->student->person->full_name }}!</h2>
                    <div class="status-icon">📅</div>
                    <p class="main-text">This is a reminder <strong>{{ $reminder }}</strong> before your scheduled referral appointment at HTCGSC — Guidance and Testing Center.</p>

                    <div class="appointment-card">
                        <p class="appointment-label">Appointment Date and Time</p>
                        <p class="appointment-date">{{ $date }}</p>
                    </div>

                    <p class="footer-note">This is an automated message, please do not reply.</p>
                </div>
            </div>
        </div>
    </body>
</html>
