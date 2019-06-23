@extends('DCommon::master')
@section('head.title', __('Dashboard'))
@section('content')
@foreach (DashBoardReports() as $key=>$item)
<div class="row">
    @foreach ($item as $value)
    @include('Common::layouts.Reports.'.$key,['option'=>$value])
    @endforeach
</div>
@endforeach
@endsection