<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('welcome');
});

// 컨트롤러 메서드를 호출하는 방식의 라우트
use App\Http\Controllers\TaskController;
Route::get('index2', [TaskController::class, 'index']);

// 라우트 파라미터
Route::get('users/{id}/friends', function($id) {
    return "ID: " . $id;
});

// 라우트 파라미터 옵션
/*Route::get('users/{id?}', function($id = 'default') {
    return "ID: " . $id;
});*/
/*Route::get('hello/world/{name?}', function ($name = null) {
    return "Hello World $name";
});*/

// 라우트 파라미터 정규 표현식 조건 추가 - 정규 표현식 조건에 만족하는 경우에만 라우트 매칭
Route::get('users/{id}', function($id){
    return "ID Number: " . $id;
})->where('id', '[0-9]+'); // 숫자만
Route::get('users/{name}', function($name) {
    return "Name: " . $name;
})->where('name', '[A-Za-z]+'); // 영어만
Route::get('posts/{id}/{slug}', function($id, $slug){
    return "Id:".$id."/Slug:".$slug;
})->where(['id'=> '[0-9]+', 'slug'=>'[A-Za-z]+']);

// 라우트 그룹
Route::group([], function() {
    Route::get('hello', function() {
        return 'Hello!';
    });
    Route::get('world', function() {
        return 'World!';
    });
});

// 로그인한 사용자만 접근하게 지정한 라우트 그룹
Route::middleware('auth')->group(function() {
    Route::get('dashboard', function() {
        return 'dashboard';
    });
    Route::get('account', function() {
        return 'account';
    });
});

// 특정 라우트를 접속 제한하기
Route::middleware(['throttle:uploads'])->group(function() {
    Route::get('/photos', function() {
        return 'PHOTOS';
    });
});

// 라우트 그룹으로 URL 접두사 붙이기]
Route::prefix('plant')->group(function() {
    Route::get('/', function() {
        return 'PLANT';
    });
    Route::get('flower', function() {
        return 'PLANT/FLOWER';
    });
});

// 모든 라우트 매칭 실패 시 대체 라우트 정의
Route::fallback(function () {
    return "ERROR";
});

// 서브도메인 라우팅
/*Route::domain('sub.myapp.com')->group(function() {
    Route('/', function() {
        return "SUB";
    });
});

// 서브도메인을 인자로 받을 수 있도록 정의된 라우트
Route::domain('{account}.myapp.com')->group(function() {
    Route::get('/', function ($account) {
        return $account;
    });
    Route::get('users/{id}', function($account, $id) {
        return $account."/".$id;
    });
});
*/

// response 인스턴스 사용하여 인자 출력
/*use Illuminate\http\Response;
Route::get('hello/world/{name}', function($name = 'Sun Flower'){
    $response = new Response('Hello World '. $name, 200);
    $response->header('Content-Type', 'text/plain');
    return $response;
});*/
// response() 글로벌 헬퍼 함수 사용하여 인자 출력
Route::get('hello/world/{name}', function($name = 'Sun Flower'){
    return response('HELPER: Hello World '.$name, 200)
        ->header('Content-Type', 'text/plain')
        ->header('Cache-Control', 'max-age='.(60*60).' must-revalidate');
});

// response() 헬퍼 함수를 사용하여 JSON 데이터 인자 출력
Route::get('hello/json', function() {
    $data = ["name"=>"Hong", "gender"=>"Kim"];
    return response()->json($data);
});

// HTML 출력
Route::get('hello/htmlcode', function() {
    $content = <<<HTML
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>TEST</title>
</head>
<body>
    <h1>라라벨 뷰 테스트하기</h1>
    <h3>PHP 프레임워크 라라벨 학습</h3>
</body>
</html>
HTML;
    return $content;
});

// html.php 페이지 전달
Route::get('hello/htmldoc', function() {
    // Laravel에서 제공하는 view() 헬퍼 함수를 사용
    return view('hello.html');

    // View 클래스의 make 함수를 사용하여 View 템플릿 (hello.html) 인스턴스 생성하여 전달
    return View::make('hello.html'); // ./hello/html.php
});

// 라우트 별칭 => /goodbye를 'greeting'이라고 별칭해주기
Route::get('goodbye', [
    'as'=>'greeting',
    function() {
        return '인사합니다.';
    }
]);
// route() 도우미 함수를 사용하여 다른 라우트로 이동
Route::get('/greeting', function() {
    // route(string $name, array $paramemter=>[])
    return redirect(route('greeting'));
});

// view()에 의해 만들어진 view 인스턴스에 with() 를 체이닝하여 데이터(name)를 바인딩 해줌
Route::get('hello/html', function() {
    return view("hello.html")->with('name','젤다');
});
Route::get('hello/html', function() {
    // 데이터가 2개 이상일 경우 배열 형태로 넣어주기
    return view("hello.html")->with(['name'=>'고구마', 'greeting'=>"안녕하세요?"]);
});
Route::get('hello/html', function() {
    // view() 함수 인자로 데이터를 바로 넣어줄 수 있음
    return view('hello.html', ['name'=>'사과', 'greeting'=>"(안녕하세요)..."]);
});

/*
 * blade 문법 핵심 기능
 * 1. String Interpolation 문자열 보간(string 안에 직접 변수 이름을 집어 넣는 방법)
 * 2. Control Structure 제어 구조
 * 3. Template Inheritance
 * 4. 조각 View 삽입
 */
Route::get('hello/blade', function() {
    // view() 함수 인자로 데이터를 바로 넣어줄 수 있음
    return view('hello.html2', ['name'=>'배', 'greeting'=>"(안녕하세요)...", 'memo'=>"<script>alert('XSS 공격!')</script>"]);
});
// if 문법
Route::get('if/{num}', function($num) {
    return view('exif', ['num'=>$num]);
    //return view('exif')->with('num', $num);
});
// for 문법
Route::get('for', function() {
    $arr = ['사과','배','수박','딸기'];
    $arr2 = array();
    $members = [
        ['name'=>'홍길동', 'age'=>30, 'address'=>'한양'],
        ['name'=>'허균', 'age'=>50, 'address'=>'한양']
    ];
    return view('exfor', ['arr'=>$arr, 'arr2'=>$arr2, 'members'=>$members]);
});
// Template Inheritance
Route::get('child', function() {
    $members = [
        ['name'=>'홍길동', 'age'=>30, 'address'=>'한양'],
        ['name'=>'허균', 'age'=>50, 'address'=>'한양']
    ];
    return view('child', ['members'=>$members]);
});

