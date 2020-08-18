@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <a href="{{ route('admin.attributes.create') }}" style=" width: 200px" class="lcPageContentSort__btn btn">Добавить</a>
        <br><br>
        <div class="lcPageContentTable">
            <div class="lcPageContentRow">
                <div class="lcPageContentCol ">
                    #
                </div>
                <div class="lcPageContentCol ">
                    Название
                </div>
                <div class="lcPageContentCol">
                    Slug
                </div>
                <div class="lcPageContentCol">
                    Выводить в фильтре
                </div>
            </div>
            @foreach ($attributes as $attr)
                <div class="lcPageContentRow">
                    <div class="lcPageContentCol">
                        {{ $attr->id }}
                    </div>
                    <div class="lcPageContentCol">
                        <a href="{{ route('admin.attributes.edit', $attr) }}">
                            {{ $attr->name }}
                        </a>
                    </div>
                    <div class="lcPageContentCol">
                        {{ $attr->slug }}
                    </div>
                    <div class="lcPageContentCol">
                        @if($attr->is_filter === 1)
                            Выводить
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection