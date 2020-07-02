<?php
    $form_data = json_decode(WebSettingGet($group_by), true);
    $form_data = (is_null($form_data)) ? [] : $form_data;
?>
<div class="col-md-12">
    @forelse ($form_data as $item)
    <div class="form-group">
        <label class="control-label col-lg-2">@lang('option')</label>
        <div class="col-md-5">
            <input type="text" dir="auto" class="form-control" value="{{ $item['ar'] }}" name="{{$group_by}}[{{ $index }}][ar]" placeholder="Arabic" />
        </div>
        <div class="col-md-5">
            <input type="text" dir="auto" class="form-control" value="{{ $item['en'] }}" name="{{$group_by}}[{{ $index }}][en]" placeholder="English" />
        </div>
    </div>
    <?php $index++; ?>
    @empty
    <div class="form-group">
        <label class="control-label col-lg-2">@lang('option')</label>
        <div class="col-md-5">
            <input type="text" dir="auto" class="form-control" name="{{$group_by}}[0][ar]" placeholder="Arabic" />
        </div>
        <div class="col-md-5">
            <input type="text" dir="auto" class="form-control" name="{{$group_by}}[0][en]" placeholder="English" />
        </div>
    </div>
    @endforelse
    <div class="New-Rows"></div>
</div>
@push('scripts')
<script>
    var index = <?php echo $index; ?>;
    $('.AddRow').click(function () {
        var input = '<div class="form-group">';
        input += '<label class="control-label col-lg-2">option</label>';
        input += '<div class="col-md-5">';
        input += '<input type="text" dir="auto" class="form-control" name="{{$group_by}}[' + index + '][ar]" placeholder="Arabic" />';
        input += '</div>';
        input += '<div class="col-md-5">';
        input += '<input type="text" dir="auto" class="form-control" name="{{$group_by}}[' + index + '][en]" placeholder="English" />';
        input += '</div>';
        input += '</div>';
        $('.New-Rows').append(input);
        index = index + 1;
    });
</script>
@endpush