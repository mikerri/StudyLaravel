<ul>
    @foreach($arr as $item)
    <li>{{$item}}</li>
    @endforeach
</ul>

<ul>
    @for($i = 0; $i < count($arr); $i++)
    <li>{{$arr[$i]}}</li>
    @endfor
</ul>

<!-- forelse: 데이터가 없을 경우 함께 처리, Laravel에서만 제공 -->
<ul>
    @forelse($arr2 as $item)
    <li>{{$item}}</li>
    @empty
    <li>데이터가 없습니다.</li>
    @endforelse
</ul>

<table border="1">
    <tr>
        <th>이름</th>
        <th>나이</th>
        <th>주소</th>
    </tr>
    @foreach($members as $member)
    <tr>
        <td>{{$member['name']}}</td>
        <td>{{$member['age']}}</td>
        <td>{{$member['address']}}</td>
    </tr>
    @endforeach
</table>
