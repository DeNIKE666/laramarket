@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <div class="lcPageContentData__title">
            Добавление характеристики
        </div>
        <br>
        <br>

        {{ Form::open(['route' => [ 'admin.attributes.update', $attribute], 'method' => 'put', 'class' => 'forms-sample']) }}

        <div class="form-group">
            <label>Название характеристики</label>
            {{ Form::text('name', $attribute->name, ['class' => 'form-control', 'required' => 'required']) }}

            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label>В каких категориях выводить характеристику</label><br>

            <option value=""></option>
            @foreach ($categories as $parent)
                <label class="check-inp">
                    @if($attribute->categories->where('id', $parent->id)->count())
                        {{ Form::checkbox('categories[]', $parent->id, true) }}
                    @else
                        {{ Form::checkbox('categories[]', $parent->id) }}
                    @endif
                    <span>@for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                        {{ $parent->title }}</span>
                </label><br>
            @endforeach

        </div>
        <div class="form-group">
            <label class="check-inp">
                @if($attribute->is_filter === 1)
                    {{ Form::checkbox('is_filter', 1, true) }}
                @else
                    {{ Form::checkbox('is_filter', 1) }}
                @endif
                <span>Выводить в фильтре</span>
            </label>
        </div>
        <div class="form-group">
            <button type="submit" style=" width: 200px" class="lcPageContentSort__btn btn">Сохранить</button>
        </div>
        {{ Form::close() }}

    </div>

@endsection