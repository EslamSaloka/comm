<?php $x = 0; ?>
<div class="privacy-list-items">
    <ul>
        @foreach ($content['ul'] as $v)
        <li class="single-info">
            <p class="txt">
                {{ $v }}
            </p>
        </li>
        @endforeach
    </ul>
</div>
