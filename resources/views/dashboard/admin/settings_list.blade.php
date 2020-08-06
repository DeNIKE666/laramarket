@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="card-title">Список настроек</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>slug</th>
                                    <th>Описание</th>
                                    <th>Значение</th>
                                </tr>
                                </thead>
                                <tbody>
                                @each('dashboard.admin.block.item_setting', $settings, 'setting')
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="card-title">Добавить настройку</h4>
                            {{ Form::open(['route' => [ 'admin.settings.store'], 'method' => 'post', 'class' => 'forms-sample']) }}

                            <div class="form-group">
                                <label>Slug</label>
                                {{ Form::text('slug', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>Описание</label>
                                {{ Form::text('name', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>Значение</label>
                                {{ Form::text('value', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
