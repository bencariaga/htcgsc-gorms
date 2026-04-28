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
        </style>
    </head>

    <body>
        <div class="wrapper">
            <div class="container">
                <div class="content">
                    <div class="status-icon">{{ $config['icon'] }}</div>
                    <h2 class="greetings">Greetings, {{ $user->person->full_name }}!</h2>
                    <p class="main-text">{!! $config['text'] !!}</p>
                    <p class="footer-note">Contact the administrator for more details and other clarifications.</p>
                </div>
            </div>
        </div>
    </body>
</html>
