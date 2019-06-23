@extends('DCommon::master')
@section('content') 
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">@lang('Edit User')</h5>
        <div class="heading-elements">
            <a href="{{route('dashboard.address.index',$user->id)}}" class="btn btn-success legitRipple">@lang('User Addresses')</a>
        </div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" 
              method="post" 
              action="{{ route('dashboard.users.update',$user->id) }}"
              enctype="multipart/form-data">
            <fieldset>
                <?php echo from_input('name', 'Name', 'text', $user->name); ?>
                @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                <?php echo from_input('mobile', 'Mobile', 'number', $user->mobile); ?>
                @error('mobile')<p class="text-danger">{{ $message }}</p>@enderror
                <?php echo from_input('email', 'Email', 'email', $user->email) ?>
                <?php echo from_input('password', 'Password', 'password', '', null, 'new-password') ?>
                <?php echo from_submit(); ?>
                <div class="hidden">
                    @csrf
                    @method('PUT')
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
