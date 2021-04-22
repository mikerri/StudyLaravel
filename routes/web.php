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

// # 컨트롤러 메서드를 호출하는 방식의 라우트
use App\Http\Controllers\TaskController;
Route::get('index2', [TaskController::class, 'index']);

// # 라우트 파라미터
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

// # 라우트 파라미터 정규 표현식 조건 추가 - 정규 표현식 조건에 만족하는 경우에만 라우트 매칭
Route::get('users/{id}', function($id){
    return "ID Number: " . $id;
})->where('id', '[0-9]+'); // 숫자만
Route::get('users/{name}', function($name) {
    return "Name: " . $name;
})->where('name', '[A-Za-z]+'); // 영어만
Route::get('posts/{id}/{slug}', function($id, $slug){
    return "Id:".$id."/Slug:".$slug;
})->where(['id'=> '[0-9]+', 'slug'=>'[A-Za-z]+']);

// # 라우트 그룹
Route::group([], function() {
    Route::get('hello', function() {
        return 'Hello!';
    });
    Route::get('world', function() {
        return 'World!';
    });
});

// # 로그인한 사용자만 접근하게 지정한 라우트 그룹
Route::middleware('auth')->group(function() {
    Route::get('dashboard', function() {
        return 'dashboard';
    });
    Route::get('account', function() {
        return 'account';
    });
});

// # 특정 라우트를 접속 제한하기
Route::middleware(['throttle:uploads'])->group(function() {
    Route::get('/photos', function() {
        return 'PHOTOS';
    });
});

// # 라우트 그룹으로 URL 접두사 붙이기]
Route::prefix('plant')->group(function() {
    Route::get('/', function() {
        return 'PLANT';
    });
    Route::get('flower', function() {
        return 'PLANT/FLOWER';
    });
});

// # 모든 라우트 매칭 실패 시 대체 라우트 정의
Route::fallback(function () {
    return "ERROR";
});

// # 서브도메인 라우팅
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

// # response() 헬퍼 함수를 사용하여 JSON 데이터 인자 출력
Route::get('hello/json', function() {
    $data = ["name"=>"Hong", "gender"=>"Kim"];
    return response()->json($data);
});

// # HTML 출력
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

// # html.php 페이지 전달
Route::get('hello/htmldoc', function() {
    // Laravel에서 제공하는 view() 헬퍼 함수를 사용
    return view('hello.html');

    // View 클래스의 make 함수를 사용하여 View 템플릿 (hello.html) 인스턴스 생성하여 전달
    return View::make('hello.html'); // ./hello/html.php
});

// # 라우트 별칭 => /goodbye를 'greeting'이라고 별칭해주기
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

// # view()에 의해 만들어진 view 인스턴스에 with() 를 체이닝하여 데이터(name)를 바인딩 해줌
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
 * # blade 문법 핵심 기능
 * 1. String Interpolation 문자열 보간(string 안에 직접 변수 이름을 집어 넣는 방법)
 * 2. Control Structure 제어 구조
 * 3. Template Inheritance
 * 4. 조각 View 삽입
 */
Route::get('hello/blade', function() {
    // view() 함수 인자로 데이터를 바로 넣어줄 수 있음
    return view('hello.html2', ['name'=>'배', 'greeting'=>"(안녕하세요)...", 'memo'=>"<script>alert('XSS 공격!')</script>"]);
});
// # if 문법
Route::get('if/{num}', function($num) {
    return view('exif', ['num'=>$num]);
    //return view('exif')->with('num', $num);
});
// # for 문법
Route::get('for', function() {
    $arr = ['사과','배','수박','딸기'];
    $arr2 = array();
    $members = [
        ['name'=>'홍길동', 'age'=>30, 'address'=>'한양'],
        ['name'=>'허균', 'age'=>50, 'address'=>'한양']
    ];
    return view('exfor', ['arr'=>$arr, 'arr2'=>$arr2, 'members'=>$members]);
});
// # Template Inheritance
Route::get('child', function() {
    $members = [
        ['name'=>'홍길동', 'age'=>30, 'address'=>'한양'],
        ['name'=>'허균', 'age'=>50, 'address'=>'한양']
    ];
    return view('child', ['members'=>$members]);
});

// # Controller 학습
// v7 이상일 경우 Controller를 Routing 할 때 Controller 클래스를 직접 입력하여 action 처리해줘야 함.
Route::get('task', [TaskController::class, 'task']);
//Route::get('task', function() {
//    return view('task')->with('task', ['name'=>'Task 1', 'due_date'=>'2021-04-19 16:19:10']);
//});
// 선택적 파라미터(파라미터가 선택적으로 존재하기를 원할 때 변수명 뒤에 '?' 붙여서 사용) id, arg 를 TaskController 클래스의 param 함수에 전달
Route::get('param/{id?}/{arg?}', [TaskController::class, 'param']);


// # Resource Controller 사용
use App\Http\Controllers\ArticlesController;
// Resource Controller binding
// Resource 이름은 복수형으로 지정
Route::resource('articles', ArticlesController::class);

Route::post('articles/{id?}', [ArticlesController::class , 'update']);
/*
Route::post(string $uri, closure|array|string $action);
Route::put(string $uri, closure|array|string $action);
Route::patch(string $uri, closure|array|string $action);
Route::delete(string $uri, closure|array|string $action);
Route::any(string $uri, closure|array|string $action); // HTTP Method를 구분하지 않고 경로만으로 라우팅

// $method(ex:['GET', 'POST'])에 원하는 Method 방식을 입력하면 입력한 Method 방식일 경우에만 라우팅 실행해줌
Route::match(array|string $method, string $uri, closure|array|string $action);
*/

// # Route를 name() Method 호출해 이름 지정
Route::get('articles/{id}', [ArticlesController::class, 'show'])->name('articles.show');
/* <a href='<?=route('articles.show', ['id'=>10])?>">*/
// <a href='/articles/14'>'

// # Route 서명하기 - 일회성 인증을 위한 서명된 링크에 접속하여 인증 확인
// 서명된 라우트 URL 생성
Route::get('makeinvitation', [TaskController::class, 'makeSign']);
// 서명된 라우트의 URL을 접속했을 때 서명 유효성 확인 - true / false 403 Invalid Signature
// (1) request() 도우미 함수의 hasValidSignature Method 호출하여 수동으로 검사
Route::get('invitations/{invitation}/{group}', function() {
    dd(request()->hasValidSignature());
})->name('invitations');
// (2) singed 미들웨어 사용
Route::get('invitations/{invitation}/{group}', function() {
    dd(request()->hasValidSignature());
})->name('invitations')->middleware('signed');


// # Redirect
// Global Helper Function 사용하여 redirect 응답 객체를 생성
Route::get('redirect-with-helper', function() {
    return redirect()->to('/');
});
// Global Helper Function 사용하여 Route의 이름을 가리키는 redirect 응답 객체를 생성
Route::get('redirect-with-helper', function() {
    return redirect()->route('articles.show', ['id'=>2]);
});
// Global Helper Function 간략하게 사용
Route::get('redirect-with-helper-shortcut', function() {
    return redirect('/');
});
// Facade 사용하여 redirect 응답 객체를 생성
Route::get('redirect-with-facade', function() {
    return Redirect::to('/');
});
// Route::redirect() 함수를 사용
Route::redirect('redirect-by-route', '/');
// 사용자가 이전에 방문한 페이지를 저장하는 세션기능을 활용하여 이전 방문 페이지로 이동
Route::get('redirect-back', function() {
    return redirect()->back();
});


// # 요청 중단
Route::get('something-you-cant-do', function(Illuminate\Http\Request $request) {
    // 바로 요청 중단, 입력한 HTTP 상태코드로 중단됨
    abort(403, '접속 권한이 없습니다.');

    // 첫번째 인자로 true, false 판별하는 조건식을 받고 조건의 결과에 따라 현재의 HTTP 요청 처리를 중단 여부 결정함
    abort_unless($request->has('magicToken'), 403);
    abort_if($request->user()->isBanned, 403);
});
