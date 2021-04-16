<strong># if 대체 문법</strong>
<?php if($num>10): ?>
<p><?=$num?>는 10보다 큰 수</p>
<?php else: ?>
<p><?=$num?>는 10보다 작은 수</p>
<?php endif ?>

<strong># if Blade 문법</strong>
@if($num > 10)
    <p>{{$num}}는 10보다 큰 수</p>
@elseif($num == 10)
    <p>{{$num}}는 10과 같은 수</p>
@else
    <p>{{$num}}는 10보다 작은 수</p>
@endif

