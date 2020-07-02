@if($type == 'textarea')
    <div class='form-group'>
        <label for='{{$name}}' class='control-label col-lg-2'>{{$label}}</label>
        <div class='col-md-10'>
            <textarea dir='auto' id='{{$name}}' class='form-control' name='{{$name}}' rows="7">{{$value}}</textarea>
        </div>
    </div>
    @error("{$name}")<p class="text-danger">{{ $message ?? '' }}</p>@enderror
@else
    <div class='form-group'>
        <label for='{{$name}}' class='control-label col-lg-2'>{{$label}}</label>
        <div class='col-md-10'>
            <input dir='auto' id='{{(!is_null($divID)) ? $divID : $name}}' type='{{$type}}' {{$autocomplete}} class='form-control' name='{{$name}}'
            value='{{ $value ?? old($name,$value) ?? "" }}' />
        </div>
    </div>
    @error("{$name}")<p class="text-danger">{{ $message ?? '' }}</p>@enderror
@endif