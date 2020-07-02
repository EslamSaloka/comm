@extends('DCommon::master')
@section('title',__('Edit User :NAME',['NAME'=>$user->name]))
@section('content') 
<div class="panel panel-flat">
    <div class="panel-body">
        <form class="form-horizontal" 
              method="post" 
              action="{{ route('dashboard.user.update',$user->id) }}"
              enctype="multipart/form-data">
            <fieldset>
                <?php echo from_input('name', 'Name', 'text', $user->name); ?>
                <?php echo from_input('email', 'Email', 'email', $user->email) ?>
                <?php echo from_input('phone', 'Phone', 'text', $user->display_phone) ?>
                <?php echo from_input('password', 'Password', 'password', '', null, 'new-password') ?>
                <?php echo from_input_select($countries, 'country_id', 'Country',$user->country_id) ?>
                <br>
                <hr>
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
@push('scripts')

@endpush