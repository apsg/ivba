@php
use App\Domains\Admin\Helpers\SettingsHelper
@endphp

@if(!empty(SettingsHelper::get(SettingsHelper::CTA_TEXT)))
<div class="bg-red text-white font-sora cta d-flex align-items-center p-1" id="cta">
    <div class="flex-grow-1 cta-inner">
        <div class="subtitle-1 p-1">
            {{ SettingsHelper::get(SettingsHelper::CTA_TEXT) }}
        </div>
        <div class="subtitle-1 p-1">
            <a href="{{ SettingsHelper::get(SettingsHelper::CTA_LINK) }}" class="btn-white color-red py-2 px-3 rounded cta_button font-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                     fill="currentColor">
                    <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/>
                </svg>
                {{ SettingsHelper::get(SettingsHelper::CTA_BUTTON) }}
            </a>
        </div>
        <div class="subtitle-1 p-1">
            {{ SettingsHelper::get(SettingsHelper::CTA_SECONDARY) }}
        </div>
    </div>
    <div>
        <a href="#"
           onclick="document.getElementById('cta').remove()">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff">
                <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
            </svg>
        </a>
    </div>
</div>
@endif
