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
        return 'Hello';
    });
    Route::get('world', function() {
        return 'World';
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

// view() 헬퍼 함수를 사용하여 html.php 문서 로드
Route::get('hello/htmldoc', function() {
    return view('html');
});

// 라우트 별칭
Route::get('goodbye', [
    'as'=>'greeting', function() {
        return '인사합니다.';
    }]
);

// 다른 라우트로 이동
Route::get('/greeting', function() {
    return redirect(route('greeting'));
});

// with 헬퍼 함수를 사용하여 html.php 문서에 인자 전달
Route::get('hello/html', function() {
    return view("html")->with('name','사람');
});

Route::get('hello/html', function() {
    return view("html")->with(['name'=>'사람', 'greeting'=>"안녕하세요?"]);
});

