<!doctype html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <title>TEST</title>
    </head>
    <body>
        <h1>라라벨 뷰 테스트하기</h1>
        <h3>PHP 프레임워크 라라벨 학습</h3>
        <p>{{$greeting}} {{$name}}</p>

        {{-- 변수가 없을 경우 처리하는 방법 --}}
        <!--1. PHP-->
        <p>나는 <?=isset($myname) ? $myname : '수박'?> 입니다.</p>
        <!--2. Blade1(laravel 5.6 이하)-->
{{--        <p>나는 {{$myname or '딸기'}} 입니다.</p>--}}
        <!--3. Blade2(laravel 5.7 이상)-->
        <p>나는 {{$myname ?? '복숭아'}} 입니다.</p>

        <!-- {{}} 문법은 XSS(Cross Site Scripting) 공격 막기 위해 사용 권장 -->
        <?=$memo?>
        <!-- 문자열 보간은 자동으로 escape 처리가 됨 => Sanitizing(소독화)이라고도 함 -->
        <p>{{$memo}}</p>
        <p>{{htmlentities($memo)}}</p>
        <p><?=htmlspecialchars($memo)?></p>
        <!-- 문자열 보간에 escape 처리 하지 않을 경우 -->
        {!!$memo!!}
    </body>
</html>
