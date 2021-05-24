@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>글 목록</h1>
        <hr>
        <ul>
            @forelse($memos as $memo)
            <li>
                {{ $memo->subject }}
                <small>by {{ $memo->user->name }}</small>
            </li>
            @empty
            <li><p>해당 글이 없습니다.</p></li>
            @endforelse
        </ul>
    </div>
@endsection
