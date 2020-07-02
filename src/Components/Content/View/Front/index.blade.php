@if (count($lists) <= 0)
    لايوجد صفحات
@else
    <ul>
    @foreach ($lists as $item)
        <li>
            <a href="{{ route('content.show',$item->id) }}">{{ $item->page_title }}</a>
        </li>
    @endforeach
    </ul>
@endif