<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HTCGSC Guidance Referral / Appointment Form</title>
        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: #e9ec99;
                font-family: 'Roboto', 'Helvetica', sans-serif;
                color: #1e293b;
                min-width: 0;
            }

            .main-wrapper {
                width: 100%;
                padding-top: 0.5rem;
                padding-bottom: 3rem;
            }

            .container {
                max-width: 42.5rem;
                margin-left: auto;
                margin-right: auto;
            }

            .card {
                background-color: #ffffff;
                border-radius: 0.75rem;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                margin-top: 2rem;
                margin-bottom: 1rem;
                overflow: hidden;
            }

            .card-header-accent {
                border-top: 10px solid #c7cf00;
            }

            .card-banner {
                background-color: #c7cf00;
                padding-left: 1.5rem;
                padding-right: 1.5rem;
                padding-top: 1rem;
                padding-bottom: 1rem;
            }

            .p-6 {
                padding: 1.5rem;
            }

            h1 {
                font-size: 32px;
                line-height: 1.25;
                color: #0f172a;
                margin-top: 0;
                margin-bottom: 1.5rem;
                font-weight: 400;
            }

            h2 {
                font-size: 1.125rem;
                line-height: 1.75rem;
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 0.025em;
                margin: 0;
                color: #0f172a;
            }

            p {
                margin-top: 0;
                margin-bottom: 1rem;
                font-size: 1rem;
                line-height: 1.625;
            }

            .text-slate-800 { color: #1e293b; }
            .text-slate-700 { color: #334155; }
            .text-red-500 { color: #EF4444; }

            .divider {
                margin-top: 1.5rem;
                padding-top: 1rem;
                border-top: 1px solid #9CA3AF;
            }

            .flex-row {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            .form-group {
                margin-bottom: 2rem;
            }

            .label-block {
                display: block;
                font-size: 1rem;
                color: #0f172a;
                margin-bottom: 1rem;
            }

            .input-line {
                width: 100%;
                border-bottom: 1px solid #9CA3AF;
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                font-weight: 500;
                background-color: transparent;
            }

            .radio-group {
                display: {{ $mode === 'pdf' ? 'grid' : 'flex' }};
                flex-direction: column;
                gap: 0.75rem;
                margin-top: 1rem;
            }

            .radio-container {
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .radio-outer {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 1.25rem;
                width: 1.25rem;
                border: 2px solid #9CA3AF;
                border-radius: 9999px;
            }

            .radio-inner {
                height: 0.625rem;
                width: 0.625rem;
                background-color: #6366F1;
                border-radius: 9999px;
            }

            .footer {
                text-align: center;
                padding-top: 1.5rem;
            }

            .google-logo {
                height: 2.5rem;
                object-fit: contain;
            }
        </style>
    </head>

    <body>
        <div class="main-wrapper">
            <div class="container">
                <div class="card card-header-accent">
                    <div class="p-6">
                        <h1>HTC Guidance Referral / Appointment Form</h1>
                        <p class="text-slate-800">This counseling service is exclusive for HTC students only. It is made to refer students with their emerging concerns in need of this service. Sessions shall be conducted through a face-to-face counseling and are available from Monday to Friday.</p>

                        <div class="divider">
                            <div class="flex-row">
                                <span style="font-weight: 500;">{{ $activeSubmission['School Email Address (Referrer)'] ?? 'No email provided' }}</span>
                            </div>
                            <p class="text-red-500" style="font-weight: 500; margin-top: 0.5rem;">* Indicates required question</p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="p-6">
                        <h2 style="margin-bottom: 1rem;">DATA PRIVACY STATEMENT</h2>
                        <p class="text-slate-700">The Holy Trinity College of General Santos recognizes its responsibilities covered in Republic Act No. 10173 also known as the "Data Privacy Act of 2012". In the process of fulfilling responsibilities to its stakeholders, the school collects and stores important personal information. The school upholds confidentiality in the collection, storage and disclosure of these data. Information collected from this Form will be used for its intended purpose and will only be accessed by authorized school personnel.</p>
                    </div>
                </div>

                <div class="card">
                    <div class="p-6">
                        <p class="text-slate-800">By answering this form, I give my consent to Holy Trinity College of General Santos City to collect, store and use all information I will submit. I also trust that it will be kept with confidentiality and used only for the specified purposes of counseling, referral and delivery of guidance services. <span class="text-red-500">*</span></p>
                        <div class="radio-container">
                            <div class="radio-outer"><div class="radio-inner"></div></div>
                            <span style="font-size: 1.125rem;">I agree and give my consent.</span>
                        </div>
                    </div>
                </div>

                @foreach($gfs->infoSections as $role => $description)
                    <x-google-forms.info-section :role="$role" :description="$description" :mode="$mode" :activeSubmission="$activeSubmission" :gfs="$gfs">
                        @if($loop->first)
                            <div class="form-group">
                                <label class="label-block">REFERRAL TYPE <span class="text-red-500">*</span></label>
                                <div class="radio-group" @if($mode === 'pdf') style="grid-template-columns: repeat(2, 1fr);" @endif>
                                    @foreach($gfs->referralTypes as $option)
                                        <div class="radio-container">
                                            <div class="radio-outer">
                                                @if(($activeSubmission['referral_type'] ?? '') === $option->value)
                                                    <div class="radio-inner"></div>
                                                @endif
                                            </div>
                                            <span>{{ $option->value }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </x-google-forms.info-section>
                @endforeach

                <div @if($mode === 'pdf') style="padding-top: 11rem;" @endif>
                    <div class="card">
                        <div class="card-banner">
                            <h2>APPOINTMENT INFORMATION</h2>
                        </div>

                        <div class="p-6">
                            <div class="form-group">
                                <label class="label-block">State the reason for seeking an appointment <span class="text-red-500">*</span></label>
                                <div class="input-line">
                                    {{ str(trim($activeSubmission['reason'] ?? ''))->finish('.') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="label-block">APPOINTMENT DATE (Monday to Friday) <span class="text-red-500">*</span></label>
                                <div class="input-line" style="max-width: 20rem;">
                                    {{ $activeSubmission['appointment_date'] ?? '' }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="label-block">APPOINTMENT TIME <span class="text-red-500">*</span></label>
                                <div class="radio-group" @if($mode === 'pdf') style="grid-template-columns: repeat(3, 1fr);" @endif>
                                    @foreach($gfs->appointmentTimes as $time)
                                        <div class="radio-container">
                                            <div class="radio-outer">
                                                @if(($activeSubmission['appointment_time'] ?? '') === $time->value)
                                                    <div class="radio-inner"></div>
                                                @endif
                                            </div>
                                            <span>{{ $time->value }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer">
                    <img src="{{ public_path('images/google-forms.png') }}" class="google-logo" alt="Google Forms">
                </div>
            </div>
        </div>
    </body>
</html>
