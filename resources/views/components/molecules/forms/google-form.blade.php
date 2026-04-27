@props(['gfs', 'selectedFileName', 'loadingMessage', 'submissions', 'contactReferrer', 'newTab'])

<main x-data x-show="$store.formPreview.activeSubmission" x-cloak class="flex-1 flex flex-col min-w-0 overflow-y-auto [scrollbar-width:thin] [scrollbar-color:rgba(107,114,128,0.8)_transparent] [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-500/80">
    <div class="sticky top-0 z-20 bg-[#e9ec99] px-8 py-[18px] border-b border-slate-400/30 flex flex-row justify-between">
        @foreach($gfs->headerButtons as $group => $buttons)
            <div class="{{ $group === 'navigation' ? 'flex items-center gap-4' : 'flex gap-6' }}">
                @foreach($buttons as $button)
                    <button @click="{{ $button['click'] ?? '$wire.' . $button['method'] . '($store.formPreview.activeSubmission)' }}" class="flex items-center gap-2 text-slate-800 hover:text-black font-bold transition-colors">
                        <i class="fas {{ $button['icon'] }}"></i>
                        <span>{{ $button['label'] }}</span>
                    </button>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="w-full bg-[#e9ec99] pt-2 pb-12" style="font-family: 'Roboto', sans-serif;">
        <div class="max-w-[42.5rem] mx-auto space-y-4">
            <div class="bg-white rounded-xl shadow-sm border-t-[10px] border-[#c7cf00] overflow-hidden">
                <div class="p-6">
                    <h1 class="text-[32px] leading-tight text-slate-900 mb-6 font-normal">HTC Guidance Referral / Appointment Form</h1>

                    <div class="space-y-6 text-base text-slate-800">
                        This counseling service is exclusive for HTC students only. It is made to refer students with their emerging concerns in need of this service. Sessions shall be conducted through a face-to-face counseling and are available from Monday to Friday.
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-400">
                        <div class="flex flex-row justify-between">
                            <p class="text-base font-medium text-slate-700" x-text="$store.formPreview.activeSubmission?.['School Email Address (Referrer)'] || 'No email provided'"></p>
                            <a class="font-medium text-blue-600 hover:text-blue-700 hover:underline" :href="{{ $contactReferrer }}" {{ $newTab }}><i class="far fa-envelope mr-1"></i>Contact Referrer</a>
                        </div>

                        <p class="font-medium text-base text-red-500 mt-2">* Indicates required question</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="font-medium text-lg mb-4 uppercase tracking-wide text-slate-900">DATA PRIVACY STATEMENT</h2>
                <p class="text-base text-slate-700 leading-relaxed">The Holy Trinity College of General Santos recognizes its responsibilities covered in Republic Act No. 10173 also known as the "Data Privacy Act of 2012". In the process of fulfilling responsibilities to its stakeholders, the school collects and stores important personal information. The school upholds confidentiality in the collection, storage and disclosure of these data. Information collected from this Form will be used for its intended purpose and will only be accessed by authorized school personnel.</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-base text-slate-900 mb-6">By answering this form, I give my consent to Holy Trinity College of General Santos City to collect, store and use all information I will submit. I also trust that it will be kept with confidentiality and used only for the specified purposes of counseling, referral and delivery of guidance services. <span class="text-red-500">*</span></p>

                <label class="flex items-center gap-3">
                    <div class="relative flex items-center">
                        <input type="radio" checked class="peer h-5 w-5 appearance-none rounded-full border-2 border-gray-400">
                        <div class="pointer-events-none absolute left-1/2 top-1/2 h-2.5 w-2.5 -translate-x-1/2 -translate-y-1/2 rounded-full bg-indigo-500 opacity-0 transition-opacity peer-checked:opacity-100"></div>
                    </div>
                    <span class="text-lg text-slate-800">I agree and give my consent.</span>
                </label>
            </div>

            @foreach($gfs->infoSections as $role => $description)
                @php $type = str($role)->lower()->title(); @endphp

                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-4">
                    <div class="bg-[#c7cf00] px-6 py-4">
                        <h2 class="text-lg font-medium uppercase text-slate-900">BASIC INFORMATION ({{ $type }})</h2>
                    </div>

                    <div class="p-6 space-y-8">
                        <p class="text-base text-slate-800">{{ $description }}</p>

                        @foreach($gfs->fields as $field)
                            <div class="space-y-4">
                                <label class="block text-base text-slate-900">{{ $field['label'] }} ({{ $type }}) @if($field['required']) <span class="text-red-500">*</span> @endif</label>
                                <input type="{{ $field['type'] }}" readonly :value="$store.formPreview.activeSubmission?.['{{ $field['label'] }} ({{ $type }})'] || ''" placeholder="Your answer" class="w-full md:w-1/2 border-b border-slate-400 focus:border-[#c7cf00] outline-none py-2 font-medium bg-transparent cursor-default">
                            </div>
                        @endforeach

                        <div class="space-y-4">
                            <label class="block text-base text-slate-900">Suffix ({{ $type }})</label>

                            @foreach($gfs->personSuffixes as $suffix)
                                <label class="flex items-center gap-3">
                                    <div class="relative flex items-center">
                                        <input type="radio" :checked="$store.formPreview.activeSubmission?.['Suffix ({{ $type }})'] === '{{ $suffix->value }}'" name="suffix_{{ str($role)->lower() }}" class="peer h-5 w-5 appearance-none rounded-full border-2 border-gray-400">
                                        <div class="pointer-events-none absolute left-1/2 top-1/2 h-2.5 w-2.5 -translate-x-1/2 -translate-y-1/2 rounded-full bg-indigo-500 opacity-0 transition-opacity peer-checked:opacity-100"></div>
                                    </div>
                                    <span class="text-base text-slate-800 cursor-default">{{ $suffix->value }}</span>
                                </label>
                            @endforeach
                        </div>

                        @if($role === collect($gfs->infoSections)->keys()->first())
                            <div class="space-y-4">
                                <label class="block text-base text-slate-900">REFERRAL TYPE <span class="text-red-500">*</span></label>

                                @foreach($gfs->referralTypes as $option)
                                    <label class="flex items-center gap-3">
                                        <div class="relative flex items-center">
                                            <input type="radio" :checked="$store.formPreview.activeSubmission?.referral_type === '{{ $option->value }}'" class="peer h-5 w-5 appearance-none rounded-full border-2 border-gray-400">
                                            <div class="pointer-events-none absolute left-1/2 top-1/2 h-2.5 w-2.5 -translate-x-1/2 -translate-y-1/2 rounded-full bg-indigo-500 opacity-0 transition-opacity peer-checked:opacity-100"></div>
                                        </div>
                                        <span class="text-base text-slate-800 cursor-default">{{ $option->value }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="bg-[#c7cf00] px-6 py-4">
                    <h2 class="text-lg font-medium uppercase text-slate-900">APPOINTMENT INFORMATION</h2>
                </div>

                <div class="p-6 space-y-8">
                    <div class="space-y-4">
                        <label class="block text-base text-slate-900">State the reason for seeking an appointment <span class="text-red-500">*</span></label>
                        <input type="text" readonly :value="$store.formPreview.activeSubmission?.reason.trim().replace(/\.*$/, '') + '.'" class="w-full border-b border-slate-400 focus:border-[#c7cf00] outline-none py-2 bg-transparent cursor-default">
                    </div>

                    <div class="space-y-4">
                        <label class="block text-base text-slate-900">APPOINTMENT DATE (between Monday and Friday only) <span class="text-red-500">*</span></label>
                        <input type="date" readonly :value="$store.formPreview.activeSubmission?.appointment_date || ''" class="w-full max-w-xs border-b border-slate-400 outline-none py-2 bg-transparent cursor-default">
                    </div>

                    <div class="space-y-4">
                        <label class="block text-base text-slate-900">APPOINTMENT TIME <span class="text-red-500">*</span></label>

                        @foreach($gfs->appointmentTimes as $time)
                            <label class="flex items-center gap-3">
                                <div class="relative flex items-center">
                                    <input type="radio" :checked="$store.formPreview.activeSubmission?.appointment_time === '{{ $time->value }}'" class="peer h-5 w-5 appearance-none rounded-full border-2 border-gray-400">
                                    <div class="pointer-events-none absolute left-1/2 top-1/2 h-2.5 w-2.5 -translate-x-1/2 -translate-y-1/2 rounded-full bg-indigo-500 opacity-0 transition-opacity peer-checked:opacity-100"></div>
                                </div>
                                <span class="text-base text-slate-800 cursor-default">{{ $time->value }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center pt-6 space-y-2">
                @foreach($gfs->footerLinks as $link)
                    @if(collect($link)->has('isImage') && $link['isImage'])
                        <div class="flex justify-center pt-4">
                            <a href="{{ $link['url'] }}" {{ $newTab }} class="hover:opacity-80 transition-opacity">
                                <img class="h-[2.5rem] object-contain" src="{{ asset('images/google-forms.png') }}" alt="Google Forms">
                            </a>
                        </div>
                    @else
                        <p class="text-[14px] text-slate-600">
                            {{ $link['prefix'] ?? '' }}
                            <a href="{{ $link['url'] }}" {{ $newTab }} class="hover:text-black {{ $link['class'] ?? 'underline' }}">{{ $link['text'] }}</a>
                        </p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</main>
