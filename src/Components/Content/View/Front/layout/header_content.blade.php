@if(!is_null($header[0]))
<div class="about-image">
    <img src="{{ url($header[0]) }}" alt="{{ WebSettingGet('website_name') }}">
</div>
@endif
@if(!is_null($header[1]))
<div class="privacy-info">
    <p class="txt">
        {{ $header[1] }}
    </p>
</div>
@endif