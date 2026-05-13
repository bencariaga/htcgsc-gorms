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
            .main-text { font-size: 14px; color: #4B5563; }
            .appointment-card { background: #f8faff; border: 2px dashed #2575fc; border-radius: 12px; padding: 20px; margin: 25px 0; }
            .appointment-label { margin: 0; font-weight: bold; color: #4B5563; text-transform: uppercase; letter-spacing: 1.5px; font-size: 14px; }
            .appointment-date { margin: 10px 0 0 0; color: #2575fc; font-size: 18px; font-weight: bold; }
            .footer-note { font-size: 14px; font-weight: bold; color: #4B5563; margin-top: 30px; }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <div class="container">
                <div class="content">
                    <h2 class="greetings">Greetings, {{ $referral->student->person->full_name }}!</h2>

                    <p class="main-text">This is a reminder <strong>{{ $reminder }}</strong> before your scheduled referral appointment at<br><strong>HTCGSC – Guidance and Testing Center</strong>.</p>

                    <div class="appointment-card">
                        <p class="appointment-label">Appointment Date and Time:</p>
                        <p class="appointment-date">{{ $date }}</p>
                    </div>

                    <p class="footer-note">This is an automated message, please do not reply.</p>
                </div>
            </div>
        </div>
    </body>
</html>
