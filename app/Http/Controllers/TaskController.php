<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class TaskController extends Controller // Controller 상속
{
    public function task()
    {
        return view('task')->with('task', ['name'=>'Task 1', 'due_date'=>'2021-04-19 16:19:10']);
    }

    // TypeHinting
    public function param(Request $request, $id=1, $arg='argument')
    {
        // return ['id'=>$id, 'arg'=>$arg];

        // path(): 현재 URL의 경로 표시 => param/12/argument
        // url(): 현재 URL 표시 => http://127.0.0.1:8000/param/12/argument
        // fullUrl(): 현재 URL 표시, QueryString(? 이하 문자열)도 함께 표시 => http://127.0.0.1:8000/param/12/argument?arg=p
        // method(): Http 파라미터 전송방식(POST, GET, PUT, DELETE)
        // get({이름}): get 방식으로 전달된 특정 인자를 가져오기
        // ajax(): ajax 요청하였는지 확인(boolean 으로 반환)
        // header(): header 값 표시하기
        dump(['path'=>$request->path()
            , 'url'=>$request->url()
            , 'fullUrl'=>$request->fullUrl()
            , 'method'=>$request->method()
            , 'arg'=>$request->get('arg')
            , 'ajax'=>$request->ajax()
            , 'header'=>$request->header()
            , 'header'=>$request->header('host')
        ]);
    }

    public function makeSign()
    {
        // 일반 URL 링크
        //return URL::get('invitations', ['invitation'=>5816, 'group'=>678]);
        // 서명된 링크
        //return URL::signedRoute('invitations', ['invitation'=>5816, 'group'=>678]);
        // 유효기간이 있는 서명된 링크
        return URL::temporarySignedRoute(
            'invitations',
            now()->addHours(4),
            ['invitation'=>5816, 'group'=>678]
        );
    }
}
