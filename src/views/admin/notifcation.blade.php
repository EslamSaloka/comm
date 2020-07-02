<?php 
    $coupon = \App\Components\Coupon\Model\Report::where(['status'=>0])->orderBy('id','DESC')->get();
?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white;">
        <i class="icon-bell2"></i>
        <span class="visible-xs-inline-block position-right">@lang('Notifcation')</span>
        @if (count($coupon) > 0)
            <span class="status-mark border-pink-300"></span>
        @endif
    </a>

    <div class="dropdown-menu dropdown-content">
        <div class="dropdown-content-heading">
            @lang('Notifcation')
        </div>

        <ul class="media-list dropdown-content-body width-350">
            @if (count($coupon) > 0)
            @foreach ($coupon as $item)
            <li class="media">
                <div class="media-left">
                    <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs">
                        <i class="icon-mention"></i>
                    </a>
                </div>

                <div class="media-body">
                    <a href="{{route('dashboard.coupon.report.show',$item->id)}}">{{$item->report_information}}</a>
                    <div class="media-annotation">{{$item->created_at}}</div>
                </div>
            </li>
            @endforeach
            @else 
                <li class="media" style="text-align: center;padding: 30px;">
                    @lang("Don't Have Notifcation")
                </li>
            @endif
        </ul>
    </div>
</li>