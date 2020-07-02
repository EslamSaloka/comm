@extends('FCommon::layouts.basic')
@section('title',__('Contact us'))
@section('content')
@include('this::map')
<!-- contact section -->
<section class="contactPg-section">
    <div class="container">
        <div class="flex-section">
            <!-- leave comment -->
            @include('this::form')
            @include('this::info')
        </div>
    </div>
</section>
@endsection