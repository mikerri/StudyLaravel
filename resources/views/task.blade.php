@extends('layouts.master')

@section('content')
    <h1>To Do List</h1>
    <p>작업:: {{ $task['name'] }}</p>
    <p>기한:: {{ $task['due_date'] }}</p>
@endsection
