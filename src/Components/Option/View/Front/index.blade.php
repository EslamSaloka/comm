<table>
    <tr>
        <th>type</th>
        <th>value</th>
    </tr>
    @foreach ($lists as $key=>$value)
        <tr>
            <td>{{ $key }}</td>
            <td>{!! WebSettingGet($key) !!}</td>
        </tr>
    @endforeach
</table>