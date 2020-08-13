@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <div class="lcPageContentData__title">
            Добавление категории
        </div>
        <br>
        <br>

        {{ Form::open(['route' => [ 'categories.store'], 'method' => 'post', 'class' => 'forms-sample']) }}

        <div class="form-group">
            <label>Название категории</label>
            {{ Form::text('title', '', ['class' => 'form-control', 'required' => 'required']) }}

            @if ($errors->has('title'))
                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="parent">Родительская категория</label>
            <select id="parent" class="form-control{{ $errors->has('parent') ? ' is-invalid' : '' }}" name="parent">
                <option value=""></option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}"{{ $parent->id == old('parent') ? ' selected' : '' }}>
                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                        {{ $parent->title }}
                    </option>
                @endforeach;
            </select>
            @if ($errors->has('parent'))
                <span class="invalid-feedback"><strong>{{ $errors->first('parent') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            {{ Form::textarea('content', '', ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <button type="submit" style=" width: 200px" class="lcPageContentSort__btn btn">Сохранить</button>
        </div>
        {{ Form::close() }}

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script>
        $('.textarea').ckeditor();
    </script>
@endpush
