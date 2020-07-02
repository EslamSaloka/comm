<div class="contactData">
    <div class="contact-header">
        <h1 class="txt">@lang('Communication data')</h1>
    </div>
    <div class="info">
        <div class="icn"><i class="fas fa-home"></i></div>
        <div class="data">
            <span class="txt">{{ WebSettingGet('address_'.App::getLocale()) }}</span>
        </div>
    </div>
    <div class="info">
        <div class="icn"><i class="fas fa-phone"></i></div>
        <div class="data">
            <span class="txt">{{ WebSettingGet('mobile') }}</span>
        </div>
    </div>
    <div class="info">
        <div class="icn"><i class="fas fa-envelope"></i></div>
        <div class="data">
            <span class="txt">{{ WebSettingGet('email') }}</span>
        </div>
    </div>
    <div class="ourSocial">
        <div class="header">
            <p class="txt">@lang('Follow us')</p>
        </div>
        <div class="socialBtns">
            <a target="_blank" href="{{ WebSettingGet('facebook') }}" class="aFixx"><i class="fab fa-facebook-f"></i></a>
            <a target="_blank" href="{{ WebSettingGet('twitter') }}" class="aFixx"><i class="fab fa-twitter"></i></a>
            <a target="_blank" href="{{ WebSettingGet('instagram') }}" class="aFixx"><i class="fab fa-instagram"></i></a>
            <a target="_blank" href="https://wa.me/{{ WebSettingGet('whatsapp') }}" class="aFixx"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>
</div>