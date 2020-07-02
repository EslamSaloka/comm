@extends('DCommon::master')
@section('title',__('Create Admin'))
@section('content') 
<div class="panel panel-flat">
    <div class="panel-body">
        <form class="form-horizontal" 
              autocomplete="off"
              method="post" 
              action="{{ route('dashboard.admin.store') }}" 
              enctype="multipart/form-data">
            <fieldset>
                <?php echo from_input('name', 'Name', 'text'); ?>
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
