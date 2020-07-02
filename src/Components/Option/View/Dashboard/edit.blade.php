@extends('DCommon::master')
@section('title' , __($options['title']))
@section('content') 
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">@lang($options['title'])<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li>
                    @if(empty($options['items']))
                        <button type="button" class="btn btn-success legitRipple AddRow">@lang('Add New Row')</button>
                    @endif
                </li>
            </ul>
        </div>
    </div>
    <?php $index = 0; ?>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="{{ route('dashboard.option.update',$group_by) }}" enctype="multipart/form-data">
            <fieldset>
                <legend class="text-bold"><?php echo __($options['title']) ?></legend>
                    @if(!empty($options['items']))
                        @foreach ($options['items'] as $key=>$value)
                            @if (array_key_exists('source',$value))
                                <div class="form-group">
                                    <label class="control-label col-lg-2">@lang($value['title'])</label>
                                    <div class="col-md-10">
                                        <?php
                                            $index_Selected = WebSettingGet($key);
                                        ?>
                                        <select class="select" name="{{ $key }}">
                                            @foreach ($value['source'] as $id=>$title)
                                            <option value="{{ $id }}" @if($id == $index_Selected) selected @endif>{{ $title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                {!! WebSettingInput($key,$value['title'],$value['type']) !!}
                            @endif
                        @endforeach
                    @else
                        @include('Option::tabs.base',['group_by'=>$group_by])
                    @endif
                {!! from_submit() !!}
                <div class="hidden">
                    @csrf
                    @method('PUT')
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
