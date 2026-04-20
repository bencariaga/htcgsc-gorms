@props(['report', 'grid', 'slot'])

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HTCGSC-GORMS | Report Summary</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/js/all.min.js"></script>
        <style>
            @page {
                size: 13in 8.5in; margin: 0;
            }

            * {
                box-sizing: border-box;
                -webkit-print-color-adjust: exact;
            }

            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: 'Inter', sans-serif;
                background-color: #f8fafc;
                color: #0f172a;
                padding: 2.5rem;
                line-height: 1.6;
                display: flex;
                flex-direction: column;
            }

            .report-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
                margin-bottom: 2rem;
                border-bottom: 2px solid #e2e8f0;
                padding-bottom: 1.5rem;
                flex-shrink: 0;
            }

            .header-title h1 {
                font-size: 2.25rem; font-weight: 800; margin: 0; color: #1e293b; letter-spacing: -0.025em;
            }

            .header-meta {
                text-align: right; color: #64748b; font-size: 1rem; font-weight: 600;
            }

            .stats-grid {
                display: flex;
                flex-wrap: wrap;
                gap: 1.5rem;
                flex-grow: 1;
            }

            .stat-card {
                background: white;
                padding: 2rem;
                border-radius: 1.25rem;
                border: 1px solid #f1f5f9;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                gap: 1.5rem;
                break-inside: avoid;
                flex: 1 1 calc(33.333% - 1.5rem);
                min-height: 200px;
            }

            .stat-icon {
                width: 5rem;
                height: 5rem;
                border-radius: 1rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .stat-info .stat-label {
                font-size: 0.875rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: #64748b;
                margin-bottom: 0.75rem;
            }

            .stat-info .stat-value {
                font-size: 2rem;
                font-weight: 900;
                color: #1e293b;
                line-height: 1;
            }

            .slot-container {
                margin-top: 3rem;
                padding: 2rem;
                background: white;
                border-radius: 1rem;
                border: 1px solid #e2e8f0;
                flex-shrink: 0;
            }

            .page-break { page-break-before: always; }
        </style>
    </head>

    <body>
        <header class="report-header">
            <div class="header-title">
                <h1>{{ (string) ($report->title ?? 'System Report') }}</h1>

                <p style="color: #64748b; font-weight: 500; margin-top: 0; font-size: 1.25rem;">
                    Report Summary About {{ (string) ($report->data_category->value ?? 'General') }}
                </p>
            </div>

            <div class="header-meta">
                <div><i class="fa-solid fa-calendar-days"></i> <span style="letter-spacing: 0em; font-variant-numeric: tabular-nums;">Generated on {{ (string) now()->format('F d, Y | h:i:s A') }}</span></div>
                <div style="margin-top: 0.25rem; color: #475569;">HTCGSC-GORMS v1.0</div>
            </div>
        </header>

        <div class="stats-grid">
            @foreach((array) $grid as $item)
                @php
                    $item = (array) $item;
                    $label = Arr::accessible($item['label'] ?? null) ? (string) collect($item['label'])->implode(' ') : (string) ($item['label'] ?? '');
                    $value = Arr::accessible($item['value'] ?? null) ? (string) collect($item['value'])->implode(', ') : (string) ($item['value'] ?? '');
                @endphp

                <div class="stat-card">
                    @if(filled($item['icon']))
                        <div class="stat-icon" style="background-color: {{ (string) ($item['colors']['icon_bg'] ?? '#e2e8f0') }}; color: {{ (string) ($item['colors']['icon_text'] ?? '#475569') }}; border: 2px solid {{ (string) ($item['colors']['icon_border'] ?? '#cbd5e1') }};">
                            <i class="{{ (string) ($item['icon'] ?? '') }}" style="font-size: 2rem;"></i>
                        </div>
                    @endif

                    <div class="stat-info">
                        <div class="stat-label">
                            {!! $label !!}
                        </div>

                        <div class="stat-value">
                            {{ $value }}
                        </div>

                        @if(collect($item)->has('subtext'))
                            <div style="font-size: 1rem; color: #4b5563; font-weight: 600; margin-top: 0.5rem;">
                                {{ (string) $item['subtext'] }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if(filled($slot))
            <div class="slot-container page-break">
                {!! (string) $slot !!}
            </div>
        @endif
    </body>
</html>
