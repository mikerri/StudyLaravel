<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // Method: GET|HEAD
    {
        // http://127.0.0.1:8000/articles/
        return __METHOD__.': Article 컬렉션 조회';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // Method: GET|HEAD
    {
        return __METHOD__.': Article 컬렉션을 만들기 위한 폼을 담은 뷰 반환';
    }

    /*
     * POST 방식으로 데이터를 전송할 경우 라라벨은 CSRF(Cross Site Request Forgery) 공격을 막기 위해 CSRF Token 요청하여
     * Token이 있을 경우 허용하고 없을 경우 Token Mismatch 예외 발생
     * POST 방식으로 데이터 전송 시 Token이 반드시 있어야 함.
     * 만약 Token 기능 사용안하기 위해서는 VerifyCsrfToken 클래스(app/Http/Middleware/VerifyCsrfToken.php)의 $except 전역변수에 허용하고자 하는 URL 입력.\
     * protected $except = ['articles'];
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // Method: POST
    {
        return __METHOD__.': 사용자의 입력한 폼 데이터로 새로운 Article 컬렉션 만듦';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // Method: GET|HEAD
    {
        // http://127.0.0.1:8000/articles/3
        return __METHOD__.': 다음 기본키('.$id.')를 가진 Article 모델 조회';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // Method: GET|HEAD
    {
        return __METHOD__.': 다음 기본키('.$id.')를 가진 Article 모델을 수정하기 위한 폼을 갖는 뷰 반환';
    }

    /*
     * HTTP Method Override 방식으로 처리
     * HTTP Method는 GET, POST 방식으로만 처리 가능
     * REST Method는 PUT, PATCH, DELETE 방식도 존재
     * PUT, PATCH, DELETE 방식으로 데이터 전송하고자 할 경우 전송 시 Method를 명시한 키(_method)를 함께 전송해 줌.
     * _method = put
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // Method: PUT|PATCH
    {
        return __METHOD__.': 사용자의 입력한 폼 데이터로 다음 기본키('.$id.')를 가진 Article 모델 수정';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // Method: DELETE
    {
        return __METHOD__.': 다음 기본키('.$id.')를 가진 Article 모델 삭제';
    }
}
