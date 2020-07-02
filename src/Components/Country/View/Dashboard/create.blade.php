@extends('DCommon::master')
@section('title',__('New Country'))
@section('content') 
<div class="panel panel-flat">
    <div class="panel-body">
        <form class="form-horizontal" 
              autocomplete="off"
              method="post" 
              action="{{ route('dashboard.country.store') }}" 
              enctype="multipart/form-data">
            <fieldset>
                {!! localization_form_tabs($errors) !!}
                <div class="tab-content">
                    <?php $i = 0 ?>
                    @foreach (config('laravellocalization.supportedLocales') as $key => $item)
                        <div class="tab-pane @if($i == 0) active @endif" id="bottom-tab{{ $item['regional'] }}">
                            <?php echo from_input('name', 'Country Name', 'text', '', $key) ?>
                            @error($key.".name")<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                    <?php $i++ ?>
                    @endforeach
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-lg-2 control-label text-semibold">@lang('Country Postion'):</label>
                    <div class="col-lg-10">
                        <select name="parent" class="form-control">
                            <option value="0">@lang('Parent')</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @if (count($country->children) > 0)
                                    @foreach ($country->children as $v)
                                        <option value="{{ $v->id }}">{{ $country->name }} - {{ $v->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @error('parent')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
                <hr>
                    <?php echo from_input('country_code', 'Country Code', 'text') ?>
                    @error('country_code')<p class="text-danger">{{ $message }}</p>@enderror
                    <?php echo from_input('country_number', 'Country Number', 'number') ?>
                    @error('country_number')<p class="text-danger">{{ $message }}</p>@enderror
                <hr>
                <div class="form-group">
                    <label class="col-lg-2 control-label text-semibold">@lang('Country Flag'):</label>
                    <div class="col-lg-10">
                        <input type="file" name="image" class="file-input" accept="image/x-png,image/gif,image/jpeg"/>
                    </div>
                    @error('image')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
                <hr>
                <?php echo from_submit(); ?>
                <div class="hidden">
                    @csrf
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Components\Country\Requests\Dashboard\StoreRequest') !!}

    {!! AssetsAdmin('plugins/uploaders/fileinput/plugins/purify.min.js','js') !!}
    {!! AssetsAdmin('plugins/uploaders/fileinput/plugins/sortable.min.js','js') !!}
    {!! AssetsAdmin('plugins/uploaders/fileinput/fileinput.min.js','js') !!}
    {!! AssetsAdmin('pages/uploader_bootstrap.js','js') !!}


@endpush