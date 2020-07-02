@extends('DCommon::master')
@section('title', __('Content'))
@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-lg">
                <thead>
                    <tr>
                        <th data-toggle="true">@lang('Name')</th>
                        <th data-toggle="true">@lang('Status')</th>
                        <th class="text-center" style="width: 150px;"><?php echo __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lists as $list)
                    <tr>
                        <td>{{$list->page_title}}</td>
                        <td>
                            <form action="{{ route('dashboard.content.update',$list->id) }}" method="post">
                                <input name="_method" type="hidden" value="put">
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
                                <button type="submit" style=" border: 0; background: white; ">
                                    @if ($list->status == 1)
                                    <span class="label label-flat border-success text-success-600 position-right">On</span>
                                    <input type="hidden" name="status" value="off">
                                    @else
                                    <span class="label label-danger">Off</span>
                                    <input type="hidden" name="status" value="on">
                                    @endif
                                </button>
                            </form>
                        </td>

                        <td>
                            <ul class="icons-list">
                                <li>
                                    <a href="{{ route('dashboard.content.edit',$list->id) }}">
                                        <i class="icon-pencil"></i>
                                    </a>
                                </li>
                                <li>
                                    {!! delete_list_from_table('dashboard.content.destroy',$list->id) !!}
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
