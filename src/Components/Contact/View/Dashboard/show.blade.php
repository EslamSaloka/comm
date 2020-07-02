
<?php /* @var $contact \App\Components\Contact\Model\Contact */ ?>
@extends('DCommon::master')
@section('title',__('Show Contact'))
@section('content') 
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-lg">
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <th data-toggle="true" style="width: 150px">@lang('Name')</th>
                        <td>{{ $contact->name }}</td>
                    </tr>
                    <tr>
                        <th data-toggle="true" style="width: 150px">@lang('Email')</th>
                        <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                    </tr>
                    <tr>
                        <th data-toggle="true" style="width: 150px">@lang('Phone')</th>
                        <td><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></td>
                    </tr>
                    <tr>
                        <th data-toggle="true" style="width: 150px">@lang('Contact Type')</th>
                        <td>{{ $contact->type->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th data-toggle="true" style="width: 150px">@lang('Message')</th>
                        <td>{{ $contact->message }}</td>
                    </tr>
                    <tr>
                        <th data-toggle="true" style="width: 150px">@lang('Created at')</th>
                        <td>{{ $contact->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
