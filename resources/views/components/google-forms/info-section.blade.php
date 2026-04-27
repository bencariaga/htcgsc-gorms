<div style="padding-top: {{ $sectionPaddingTop }};">
    <div class="card">
        <div class="card-banner">
            <h2>BASIC INFORMATION ({{ $type }})</h2>
        </div>

        <div class="p-6">
            @if($mode !== 'pdf')
                <p class="text-slate-800" style="margin-bottom: 2rem;">{{ $description }}</p>
            @endif

            @foreach($gfs->fields as $field)
                <div class="form-group">
                    <label class="label-block">{{ $field['label'] }} ({{ $type }}) @if($field['required']) <span class="text-red-500">*</span> @endif</label>
                    <div class="input-line" style="width: 50%;">
                        {{ $activeSubmission["{$field['label']} ({$type})"] ?? '' }}
                    </div>
                </div>
            @endforeach

            <div class="form-group">
                <label class="label-block">Suffix ({{ $type }})</label>
                <div class="radio-group" @if($mode === 'pdf') style="grid-template-columns: repeat(4, 1fr);" @endif>
                    @foreach($gfs->personSuffixes as $suffix)
                        <div class="radio-container">
                            <div class="radio-outer">
                                @if(($activeSubmission["Suffix ({$type})"] ?? '') === $suffix->value)
                                    <div class="radio-inner"></div>
                                @endif
                            </div>
                            <span>{{ $suffix->value }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{ $slot }}
        </div>
    </div>
</div>
