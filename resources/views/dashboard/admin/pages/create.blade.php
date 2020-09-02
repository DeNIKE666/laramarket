@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <div class="lcPageContentData__title">
            Добавление страницы
        </div>
        <br>
        <br>

        {{ Form::open(['route' => [ 'admin.page.store'], 'method' => 'post', 'class' => 'forms-sample']) }}

        <div class="form-group">
            <label>Название</label>
            {{ Form::text('name', '', ['class' => 'form-control']) }}

            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label>Контент</label>
            {{ Form::textarea('content', '', ['class' => 'textarea']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Сохранить', ['style' => 'width: 200px;', 'class' => 'btn lcPageContentSort__btn']) }}
        </div>
        {{ Form::close() }}
    </div>
@endsection