@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <div class="lcPageContentData__title">
             Категории
        </div>
        <br>
        <a href="{{ route('categories.create') }}" style=" width: 200px" class="lcPageContentSort__btn btn">Добавить категорию</a>
<br><br>
        <div class="lcPageContentTable">
            <div class="lcPageContentRow">

                <div class="lcPageContentCol lcPageContentCol--max-width">
                    Название
                </div>
                <div class="lcPageContentCol">
                    Slug
                </div>
                <div class="lcPageContentCol">
                </div>
            </div>
            @foreach ($categories as $category)
                <div class="lcPageContentRow">

                    <div class="lcPageContentCol lcPageContentCol--max-width">
                        @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                        <a href="{{ route('categories.edit', $category) }}">{{ $category->title }}</a>
                    </div>
                    <div class="lcPageContentCol">
                        {{ $category->slug }}
                    </div>
                    <div class="lcPageContentCol">

                            <form  method="POST" action="{{ route('categories.first', $category) }}" class="order-cat">
                                @csrf
                                <button class="order-cat__btn"><i class="fas fa-angle-double-up"></i></button>
                            </form>
                            <form method="POST" action="{{ route('categories.up', $category) }}" class="order-cat">
                                @csrf
                                <button class="order-cat__btn"><i class="fas fa-angle-up"></i></button>
                            </form>
                            <form method="POST" action="{{ route('categories.down', $category) }}" class="order-cat">
                                @csrf
                                <button class="order-cat__btn"><i class="fas fa-angle-down"></i></button>
                            </form>
                            <form method="POST" action="{{ route('categories.last', $category) }}" class="order-cat">
                                @csrf
                                <button class="order-cat__btn"><i class="fas fa-angle-double-down"></i></button>
                            </form>

                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection


@push('scripts')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
@endpush
