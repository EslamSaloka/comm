@if(!is_null($footer[1]))
<div class="privacy-info">
    <p class="txt">
        {{ $footer[1] }}
    </p>
</div>
@endif
@if(!is_null($footer[0]))
<div class="about-image">
    <img src="{{ url($footer[0]) }}" alt="{{ WebSettingGet('website_name') }}">
</div>
@endif
