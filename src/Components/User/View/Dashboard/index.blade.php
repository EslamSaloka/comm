@extends('DCommon::master')
@section('title',__('Users'))
@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-lg">
                <thead>
                    <tr>
                        <th data-toggle="true">@lang('Name')</th>
                        <th data-toggle="true">@lang('Email')</th>
                        <th data-toggle="true">@lang('Phone')</th>
                        <th class="text-center" style="width: 150px;"><?php echo __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lists as $one)
                    <tr>
                        <td>{{$one->name}}</td>
                        <td>
                            <a href="mailto:{{$one->email}}">
                                {{$one->email}}
                            </a>
                        </td>
                        <td>
                            <a href="tel:{{$one->phone}}">
                                {{$one->phone}}
                            </a>
                        </td>
                        <td>
                            <ul class="icons-list">
                                <li>
                                    <a href="{{ route('dashboard.user.edit',$one->id) }}"><i class="icon-pencil"></i></a>
                                </li>
                                <li>
                                    {!! delete_list_from_table('dashboard.user.destroy',$one->id) !!}
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