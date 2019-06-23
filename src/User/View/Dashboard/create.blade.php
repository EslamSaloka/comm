@extends('DCommon::master')
@section('content') 
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">@lang('Create User')</h5>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" 
              autocomplete="off"
              method="post" 
              action="{{ route('dashboard.users.store') }}" 
              enctype="multipart/form-data">
            <fieldset>
                <?php echo from_input('', 'Name', 'text'); ?>
                @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                <?php echo from_input('mobile', 'Mobile', 'number'); ?>
                @error('mobile')<p class="text-danger">{{ $message }}</p>@enderror
                <?php echo from_input('email', 'Email', 'email', '', null, 'new-email') ?>
                <?php echo from_input('password', 'Password', 'password', '', null, 'new-password') ?>
                <?php echo from_submit(); ?>
                <div class="hidden">
                    @csrf
                </div>
            </fieldset>
        </form>
    </div>
</div>

@endsection
