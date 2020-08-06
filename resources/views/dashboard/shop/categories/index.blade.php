@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Категории</h4>
                    <p><a href="{{ route('categories.create') }}" class="btn btn-success">Добавить категорию</a></p>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Slug</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                                    <a href="{{ route('categories.edit', $category) }}">{{ $category->title }}</a>
                                </td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <form method="POST" action="{{ route('categories.first', $category) }}" class="mr-1">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-angle-double-up"></i></button>
                                        </form>
                                        <form method="POST" action="{{ route('categories.up', $category) }}" class="mr-1">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-angle-up"></i></button>
                                        </form>
                                        <form method="POST" action="{{ route('categories.down', $category) }}" class="mr-1">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-angle-down"></i></button>
                                        </form>
                                        <form method="POST" action="{{ route('categories.last', $category) }}" class="mr-1">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-angle-double-down"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
