@extends('layouts.master')

{{--@section('title')--}}
{{--    Template Inheritance TEST--}}
{{--@endsection--}}

@section('style')
    <style>
        body {background: #edf2f7; color: aqua}
    </style>
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>이름</th>
                <th>나이</th>
                <th>주소</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{$member['name']}}</td>
                <td>{{$member['age']}}</td>
                <td>{{$member['address']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @include('inc.footer')
@endsection

@section('script')
    <script>alert('Child View Section')</script>
@endsection
