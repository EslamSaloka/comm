@extends('DCommon::master')
@section('title',__('New Content')) 
@section('content') 
<div class="panel panel-flat">
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="{{ route('dashboard.content.store') }}" enctype="multipart/form-data">
            <fieldset>
                <div class="tabbable">
                    <div class="content-group-lg">
                        <h6 class="text-semibold">@lang('Content Type')</h6>
                        <select class="select select_type" name="type">
                            <option value="">@lang('Choose type')</option>
                            <option value="text">@lang('Text')</option>
                            <option value="questions">@lang('Questions')</option>
                            <option value="ul">@lang('Ul')</option>
                            <option value="ol">@lang('Ol')</option>
                        </select>
                        @error('type')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <?php $i = 0 ?>
                        @foreach (config('laravellocalization.supportedLocales') as $key=>$item)
                        <li class="@if($i == 0) active @endif">
                            <a href="#bottom-tab{{ $item['regional'] }}" data-toggle="tab">{{ $item['native'] }}</a>
                        </li>
                        <?php $i++ ?>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        <?php $i = 0 ?>
                        @foreach (config('laravellocalization.supportedLocales') as $key=>$item)
                        <div class="tab-pane @if($i == 0) active @endif" id="bottom-tab{{ $item['regional'] }}">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="content-group-lg">
                                        <h6 class="text-semibold">@lang('Page Title')</h6>
                                        {!! from_input("{$key}[page_title]",'page_title','text') !!}
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="col-md-6">
                                <div class="content-group-lg">
                                    <h6 class="text-semibold">@lang('Before the content')</h6>
                                    {!! from_image("{$key}[header_image]",'','header_image') !!}
                                    {!! from_input_textarea("{$key}[header_text]",$item['native']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="content-group-lg">
                                    <h6 class="text-semibold">@lang('After the content')</h6>
                                    {!! from_image("{$key}[footer_image]",'','footer_image') !!}
                                    {!! from_input_textarea("{$key}[footer_text]",$item['native']) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="Dtext Dall" style="display:none;">
                                    <textarea name="{{$key}}[textarea]" class="summernote">
                                    </textarea>
                                </div>
                                <div class="Dquestions Dall" style="display:none;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">@lang('Questions')</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="{{$key}}[questions][]" placeholder="Questions" />
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-success legitRipple AddQuestion">@lang('Add')</button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">@lang('Answer')</label>
                                            <div class="col-md-10">
                                                <textarea name="{{$key}}[answer][]" class="form-control" style="margin: 0px;min-width: 790px;min-height: 100px;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 RowItems{{$key}}">
                                    </div>
                                </div>
                                <div class="Dul Dall" style="display:none;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">1</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="{{$key}}[ul][]" placeholder="" />
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-success legitRipple AddUl">@lang('Add')</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 UlRowItems{{$key}}">
                                    </div>
                                </div>
                                <div class="Dol Dall" style="display:none;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">.</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="{{$key}}[ol][]" placeholder="" />
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-success legitRipple AddOl">@lang('Add')</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 OlRowItems{{$key}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i++ ?>
                        @endforeach

                    </div>
                </div>

                {!! from_submit() !!}
                <div class="hidden">
                    @csrf
                </div>
            </fieldset>
        </form>
    </div>
</div>

@push('scripts')
<script>
    var o = 0;
    $(".select_type").change(function () {
        $('.Dall').css('display', 'none');
        if ($(this).val() != '') {
            $('.D' + $(this).val()).css('display', 'block');
        }
    });
    $('.AddQuestion').click(function () {
        var lang = 'ar';
        for (var x = 0; x < 2; x++) {
            if (x == 1) {
                lang = 'en';
            }
            var row = '<div data-id="' + o + '">';
            row += '<hr/>';
            row += '<div class="form-group">';
            row += '<label class="control-label col-lg-2"><?php echo __("Questions"); ?></label>';
            row += '<div class="col-md-8">';
            row += '<input type="text" class="form-control" name="' + lang + '[questions][]" placeholder="Questions" />';
            row += '</div>';
            row += '<div class="col-md-2">';
            row += '<button type="button" class="btn btn-error legitRipple RemoveQuestion"><?php echo __("Delete"); ?></button>';
            row += '</div>';
            row += '</div>';
            row += '<div class="form-group">';
            row += '<label class="control-label col-lg-2"><?php echo __("Answer"); ?></label>';
            row += '<div class="col-md-10">';
            row += '<textarea name="' + lang + '[answer][]" class="form-control" style="margin: 0px;min-width: 790px;min-height: 100px;"></textarea>';
            row += '</div>';
            row += '</div>';
            row += '</div>';
            $('.RowItems' + lang).append(row);
        }
        o++;
    });
    $('.AddUl').click(function () {
        var lang = 'ar';
        for (var x = 0; x < 2; x++) {
            if (x == 1) {
                lang = 'en';
            }
            var row = '<div data-id="' + o + '">';
            row += '<div class="form-group">';
            row += '<label class="control-label col-lg-2">.</label>';
            row += '<div class="col-md-8">';
            row += '<input type="text" class="form-control" name="' + lang + '[ul][]" placeholder="" />';
            row += '</div>';
            row += '<div class="col-md-2">';
            row += '<button type="button" class="btn btn-error legitRipple removeme"><?php echo __("Delete"); ?></button>';
            row += '</div>';
            row += '</div>';
            row += '</div>';
            $('.UlRowItems' + lang).append(row);
        }
        o++;
    });
    $('.AddOl').click(function () {
        var lang = 'ar';
        for (var x = 0; x < 2; x++) {
            if (x == 1) {
                lang = 'en';
            }
            var row = '<div data-id="' + o + '">';
            row += '<div class="form-group">';
            row += '<label class="control-label col-lg-2">.</label>';
            row += '<div class="col-md-8">';
            row += '<input type="text" class="form-control" name="' + lang + '[ol][]" placeholder="" />';
            row += '</div>';
            row += '<div class="col-md-2">';
            row += '<button type="button" class="btn btn-error legitRipple removeme"><?php echo __("Delete"); ?></button>';
            row += '</div>';
            row += '</div>';
            row += '</div>';
            $('.OlRowItems' + lang).append(row);
        }
        o++;
    });
    $(document).on('click', '.RemoveQuestion', function () {
        $(this).parent().parent().parent().remove();
    });
    $(document).on('click', '.removeme', function () {
        $(this).parent().parent().remove();
    });
</script>
@endpush

@endsection
