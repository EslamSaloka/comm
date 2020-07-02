<?php $x = 0; ?>
@foreach ($content['questions'] as $k=>$v)
<div class="accordionFixx" id="accordion{{$x}}" role="tablist" aria-multiselectable="{{ ($x==0)?'true':'false' }}">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab">
            <a role="button" class="aFixx {{ ($x==0)?'':'collapsed' }}" data-toggle="collapse" data-parent="#accordion{{$x}}" href="#collapse{{$x}}" aria-expanded="{{ ($x==0)?'true':'false' }}" aria-controls="collapse{{$x}}">
                <span>
                    {{ $v }}
                </span>
            </a>
        </div>
        <div id="collapse{{$x}}" class="panel-collapse collapse {{ ($x==0)?'in':'' }}" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="normalTxt">
                    <p class="txt">
                        {{ $content['answer'][$k] }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $x++; ?>
@endforeach
