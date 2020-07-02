<?php $x = 0; ?>
<div class="terms-page-body">
    @foreach ($content['ol'] as $v)
    <div class="terms-info">
        <p class="txt">
            {{ ++$x }} - {{ $v }}
        </p>
    </div>
    @endforeach
</div>
