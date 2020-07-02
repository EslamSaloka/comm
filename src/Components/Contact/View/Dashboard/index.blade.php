@extends('DCommon::master')
@section('title',__('Contact'))
@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">@lang('Fillter')</h5>
        <form class="form-horizontal" method="get" action="" enctype="multipart/form-data">
        <div class="heading-elements">
            <button type="submit" value="@lang('Search')" class='btn btn-default'>
                <i class="icon-search4"></i>
            </button>
        </div>
    </div>
    <div class="panel-body">
        <?php 
            $name       = '';
            $email      = '';
            $phone      = '';
            $seen       = '';
            $type_id    = '';
            foreach(request('search',[]) as $key=>$val) {
                ${$key} = $val;
            }
        ?>
            <fieldset>
                <div class='form-group'>
                    <div class='col-md-4'>
                        <input type='text' placeholder="@lang('Name')" class='form-control' name='search[name]' value="{{ $name }}"/>
                    </div>
                    <div class='col-md-2'>
                        <input type='text' placeholder="@lang('Phone')" class='form-control' name='search[phone]' value="{{ $phone }}"/>
                    </div>
                    <div class='col-md-2'>
                        <input type='text' placeholder="@lang('Email')" class='form-control' name='search[email]' value="{{ $email }}"/>
                    </div>
                    <div class='col-md-2'>
                        <select class="form-control select-size-lg" name="search[seen]">
                            <option value=''>@lang('Choose Status')</option>
                            <option @if($seen == "1") selected @endif value='1'>@lang('Seen')</option>
                            <option @if($seen == "0") selected @endif value='0'>@lang('UnSeen')</option>
                        </select>
                    </div>
                    <div class='col-md-2'>
                        <select class="form-control select-size-lg" name="search[type_id]">
                            <option value=''>@lang('Choose Type')</option>
                            @foreach ($types as $item)
                                <option @if($item->id == $type_id) selected @endif value='{{ $item->id }}'>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<div class="panel panel-flat">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-lg">
                <thead>
                    <tr>
                        <th data-toggle="true">@lang('Name')</th>
                        <th data-toggle="true">@lang('Phone')</th>
                        <th data-toggle="true">@lang('Email')</th>
                        <th data-toggle="true">@lang('Status')</th>
                        <th data-toggle="true">@lang('Type')</th>
                        <th data-toggle="true">@lang('Created at')</th>
                        <th class="text-center" style="width: 150px;"><?php echo __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lists as $list)
                    <tr>
                        <td>{{$list->name}}</td>
                        <td>
                            <a href="tel:{{$list->phone}}">{{$list->phone}}</a>
                        </td>
                        <td>
                            <a href="mailto:{{$list->email}}">{{$list->email}}</a>
                        </td>
                        <td>
                            @if ($list->seen)
                                <span class="label bg-success-400">@lang('Seen')</span>
                            @else
                                <span class="label bg-danger">@lang('UnSeen')</span>
                            @endif
                        </td>
                        <td>{{$list->type->name ?? ''}}</td>
                        <td>{{$list->created_at}}</td>
                        <td>
                            <ul class="icons-list">
                                <li>
                                    <a href="{{ route('dashboard.contact.show',$list->id) }}">
                                        <i class="icon-eye2"></i>
                                    </a>
                                </li>
                                <li>
                                    {!! delete_list_from_table('dashboard.contact.destroy',$list->id) !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7"><?php echo __('No results') ?></td>
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
