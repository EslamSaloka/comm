@extends('DCommon::master')
@section('title',__('Edit Country :NAME',['NAME'=>$country->name]))
@section('content') 
<div class="panel panel-flat">
    <div class="panel-body">
        <form class="form-horizontal" 
              method="post" 
              action="{{ route('dashboard.country.update',$country->id) }}"
              enctype="multipart/form-data">
            <fieldset>
                {!! localization_form_tabs() !!}
                <div class="tab-content">
                    <?php $i = 0 ?>
                    @foreach (config('laravellocalization.supportedLocales') as $key => $item)
                    <div class="tab-pane @if($i == 0) active @endif" id="bottom-tab{{ $item['regional'] }}">
                        <?php echo from_input('name', 'Country Name', 'text', $country->translate($key)->name, $key) ?>
                        @error($key . '.name')<p class="text-danger">{{ $message }}</p>@enderror
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
                            @foreach ($countries as $c)
                                <option @if($c->id == $country->id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
                                @if (count($c->children) > 0)
                                    @foreach ($c->children as $v)
                                        <option @if($v->id == $country->id) selected @endif value="{{ $v->id }}">{{ $c->name }} - {{ $v->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @error('parent')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
                <hr/>
                    <?php echo from_input('country_code', 'Country Code', 'text', $country->country_code) ?>
                    @error('country_code')<p class="text-danger">{{ $message }}</p>@enderror
                    <?php echo from_input('country_number', 'Country Number', 'number', $country->country_number) ?>
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
                    @method('PUT')
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
<?php 
    $initialPreview  = '[';
    $path = url('/'.$country->image);
    $initialPreview .= "'<img src=\"{$path}\" class=\"kv-preview-data file-preview-image\" style=\"max-width: 500px;\">',\n";
    $initialPreview .= ']';
?>
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Components\Country\Requests\Dashboard\UpdateRequest') !!}

    {!! AssetsAdmin('plugins/uploaders/fileinput/plugins/purify.min.js','js') !!}
    {!! AssetsAdmin('plugins/uploaders/fileinput/plugins/sortable.min.js','js') !!}
    {!! AssetsAdmin('plugins/uploaders/fileinput/fileinput.min.js','js') !!}
    {!! AssetsAdmin('pages/uploader_bootstrap.js','js') !!}
    <script>
        $(".file-input").fileinput({
            initialPreviewFileType: 'image',
            initialPreview: {!!$initialPreview !!},
            overwriteInitial: true,
            showUpload: false,
            showRemove : false,
            fileActionSettings:{
                showRemove: true,   
            },
            removeIcone:'glyphicon glyphicon-zoom-in',
            deleteUrl:'test',
        });
</script>
@endpush