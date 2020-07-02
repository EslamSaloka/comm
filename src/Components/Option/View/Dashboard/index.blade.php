@extends('DCommon::master')
@section('title' , __("Options"))
@section('content')
@foreach ($lists as $key=>$item)
<a href="{{ route('dashboard.option.edit',$key) }}">
    <div class="col-sm-6 col-lg-3">
        <div class="panel panel-body">
            <div class="row text-center">
                <div>
                    <p><i class="{{ $item['icon'] }} icon-2x display-inline-block text-info"></i></p>
                    <h5 class="text-semibold no-margin">@lang($item['title'])</h5>
                </div>
            </div>
        </div>
    </div>
</a>
@endforeach
@endsection