<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><span class="text-semibold">@yield('title')</span></h4>
        </div>
        @if (!empty($new))
            <div class="heading-elements">
                <a style="background: #42a7f2;color: white;" href="{{ route('dashboard.'.$new['route']) }}" class="btn btn-labeled btn-labeled-right bg-bug heading-btn"> {{ __($new['label']) }} <b><i class="{{ $new['icon'] }}"></i></b></a>
            </div>
        @endif
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            @if (!empty($array))
                <li><a href="{{ route('dashboard.Dindex') }}"><i class="icon-home2 position-left"></i> @lang('Home')</a></li>
                <?php 
                    $arrayCount = count($array);
                    $count      = 1;
                ?>
                @foreach ($array as $item)
                    @if ($arrayCount == $count)
                        <li class="active">{{ __($item['name']) }}</li>
                    @else
                        <li><a href="{{ route('dashboard.'.$item['route']) }}">{{ __($item['name']) }}</a></li>
                    @endif
                    <?php  $count++; ?>
                @endforeach
            @else
                <li class="active"><i class="icon-home2 position-left"></i> @lang('Home')</li>
                
            @endif
            
        </ul>
    </div>
</div>
<div class="content" style="padding: 0 20px 0px 20px;">
        @if (\Session::has('primary'))
            <div class="alert alert-primary alert-styled-left">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">@lang('Close')</span></button>
                <span class="text-semibold">{{ Session::get('primary') }}</span> 
            </div>
        @endif
        @if (\Session::has('danger'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">@lang('Close')</span></button>
                <span class="text-semibold">{{ Session::get('danger') }}</span>
            </div>
        @endif
        @if (\Session::has('success'))
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">@lang('Close')</span></button>
                <span class="text-semibold">{{ Session::get('success') }}</span>
            </div>
        @endif
</div>