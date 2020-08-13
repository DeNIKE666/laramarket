@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <div class="lcPageContentData__title">
            Редактирование категории
        </div>
        <br>
        <br>

        {{ Form::open(['route' => ['categories.update', $category], 'method' => 'put', 'class' => 'forms-sample']) }}

        <div class="form-group">
            <label>Название категории</label>
            {{ Form::text('title', $category->title, ['class' => 'form-control', 'required' => 'required']) }}

            @if ($errors->has('title'))
                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
            @endif
        </div>
                    <div class="form-group">
                        <label for="parent">Родительская категория</label>
                        <select  name="parent" class="form-control {{ $errors->has('parent') ? ' is-invalid' : '' }}" id="parent">
                            <option value="">Нет</option>
                            @foreach ($parents as $parent)
                                <option {{ $parent->id == $category->parent_id ? ' selected' : '' }} value="{{ $parent->id }}">
                                    @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                    {{ $parent->title }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('parent'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('parent') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::textarea('content', $category->content, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <button type="submit" style=" width: 200px" class="lcPageContentSort__btn btn">Сохранить</button>
                    </div>
                    {{ Form::close() }}




    {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
    <button onclick="return confirm('Точно удалить?')" type="submit"  style=" width: 200px" class="lcPageContentSort__btn btn" title="">Удалить</button>
    {!! Form::close() !!}
@endsection

@push('scripts')
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script>
        $('.textarea').ckeditor();
    </script>
@endpush
