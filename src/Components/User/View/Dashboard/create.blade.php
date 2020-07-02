@extends('DCommon::master')
@section('title',__('Create User'))
@section('content') 
<div class="panel panel-flat">
    <div class="panel-body">
        <form class="form-horizontal" 
              autocomplete="off"
              method="post" 
              action="{{ route('dashboard.user.store') }}" 
              enctype="multipart/form-data">
            <fieldset>
                <?php echo from_input('name', 'Name', 'text'); ?>
                <?php echo from_input('email', 'Email', 'email', '', null, 'new-email') ?>
                <?php echo from_input('phone', 'Phone', 'text') ?>
                <?php echo from_input('password', 'Password', 'password', '', null, 'new-password') ?>
                <?php echo from_input_select($countries, 'country_id', 'Country') ?>
                <br>
                <hr>
                <?php echo from_submit(); ?>
                <div class="hidden">
                    @csrf
                </div>
            </fieldset>
        </form>
    </div>
</div>

@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Components\User\Requests\Dashboard\CreateRequsts') !!}
@endpush
