@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <div class="lcPageContentData__title">
            Добавление характеристики
        </div>
        <br>
        <br>

        {{ Form::open(['route' => [ 'admin.attributes.store'], 'method' => 'post', 'class' => 'forms-sample']) }}

        <div class="form-group">
            <label>Название характеристики</label>
            {{ Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) }}

            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label>В каких категориях выводить характеристику</label><br>

                <option value=""></option>
                @foreach ($categories as $parent)
                        <label class="check-inp"> {{ Form::checkbox('categories[]', $parent->id) }}<span>@for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                        {{ $parent->title }}</span>
                        </label><br>
                @endforeach

        </div>
        <div class="form-group">
            <label class="check-inp">
                {{ Form::checkbox('is_filter', 1) }} <span>Выводить в фильтре</span>
            </label>
        </div>
        <div class="form-group">
            <button type="submit" style=" width: 200px" class="lcPageContentSort__btn btn">Сохранить</button>
        </div>
        {{ Form::close() }}

    </div>

@endsection