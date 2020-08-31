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
            {{ Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) }}

            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label>Url</label>
            {{ Form::text('slug', '', ['class' => 'form-control', 'required' => 'required']) }}

            @if ($errors->has('slug'))
                <span class="invalid-feedback"><strong>{{ $errors->first('slug') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label>Контент</label>
            {{ Form::textarea('content', '', ['class' => 'textarea']) }}
        </div>
        <div class="form-group">
            <button type="submit" style=" width: 200px" class="lcPageContentSort__btn btn">Сохранить</button>
        </div>
        {{ Form::close() }}

    </div>

@endsection