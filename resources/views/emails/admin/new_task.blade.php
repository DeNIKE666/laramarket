@extends('layouts.email')

@section('content')
    <p>Новое обращение в техподдержку от {{ getName($task->user) }}</p>
@endsection