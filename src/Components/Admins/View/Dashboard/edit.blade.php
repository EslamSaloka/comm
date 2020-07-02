@extends('DCommon::master')
@section('title',__('Edit Admin :NAME',['NAME'=>$admin->name]))
@section('content') 
<div class="panel panel-flat">
    <div class="panel-body">
        <form class="form-horizontal" 
              method="post" 
              action="{{ route('dashboard.admin.update',$admin->id) }}"
              enctype="multipart/form-data">
            <fieldset>
                <?php echo from_input('name', 'Name', 'text', $admin->name); ?>
                <?php echo from_input('email', 'Email', 'email', $admin->email) ?>
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
