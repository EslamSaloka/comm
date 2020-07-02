<div class="leaveComment">
    <div class="contact-header">
        <h1 class="txt">@lang('Send us your suggestion or complaints')</h1>
    </div>
    <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        <!-- info inputs -->
        <div class="infoInpts">
            <div class="name">
                <span>@lang('full name')</span>
                <input name="name" type="text">

            </div>
        </div>
        <!-- info inputs -->
        <div class="infoInpts">
            <div class="email">
                <span>@lang('E-mail')</span>
                <input name="email" type="text">
            </div>
        </div>
        <!-- info inputs -->
        <div class="infoInpts">
            <div class="phoneNum">
                <span>@lang('Mobile number')</span>
                <input name="phone" type="text">
            </div>
        </div>
        <!-- post inputs -->
        <div class="infoInpts">
            <div class="postInput">
                <span>@lang('message')</span>
                <textarea name="message"></textarea>
            </div>
        </div>
        <div class="sendBtn">
            <button class="aFixx">@lang('Send')</button>
        </div>
    </form>
</div>
@push('scripts')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Components\Contact\Requests\Front\ContactRequest') !!}
@endpush