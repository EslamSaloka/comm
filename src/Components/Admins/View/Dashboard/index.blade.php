@extends('DCommon::master')
@section('title',__('Admins'))
@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-lg">
                <thead>
                    <tr>
                        <th data-toggle="true">@lang('ID')</th>
                        <th data-toggle="true">@lang('Name')</th>
                        <th data-toggle="true">@lang('Email')</th>
                        <th data-toggle="true">@lang('Create At')</th>
                        <th class="text-center" style="width: 150px;"><?php echo __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lists as $one)
                    <tr>
                        <td>{{$one->id}}</td>
                        <td>{{$one->name}}</td>
                        <td>{{$one->email}}</td>
                        <td>{{$one->created_at}}</td>
                        <td>
                            <ul class="icons-list">
                                <li>
                                    <a href="{{ route('dashboard.admin.edit',$one->id) }}"><i class="icon-pencil"></i></a>
                                </li>
                                <li>
                                    {!! delete_list_from_table('dashboard.admin.destroy',$one->id) !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5"><?php echo __('No results') ?></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="text-center m-20">
            {{ $lists->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection