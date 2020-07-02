@extends('DCommon::master')
@section('title',__('Edit Type :NAME',['NAME'=>$type->name]))
@section('content') 
<div class="panel panel-flat">
    <div class="panel-body">
        <form class="form-horizontal" 
              method="post" 
              action="{{ route('dashboard.contact.type.update',$type->id) }}"
              enctype="multipart/form-data">
            <fieldset>
                {!! localization_form_tabs() !!}
                <div class="tab-content">
                    <?php $i = 0 ?>
                    @foreach (config('laravellocalization.supportedLocales') as $key => $item)
                    <div class="tab-pane @if($i == 0) active @endif" id="bottom-tab{{ $item['regional'] }}">
                        <?php echo from_input('name', 'Type Name', 'text', $type->translate($key)->name, $key) ?>
                        @error($key . '.name')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                    <?php $i++ ?>
                    @endforeach
                </div>
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
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Components\Contact\Requests\Dashboard\TypeUpdateRequest') !!}
@endpush