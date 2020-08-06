@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Новое обращение</h4>
                    {{ Form::open(['route' =>  'tasks.store', 'files' =>	true, 'method' => 'post', 'class' => 'forms-sample']) }}
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Заголовок обращения</label>
                                {{ Form::text('title', '', ['class' => 'form-control', 'required' => 'required']) }}
                            </div>

                            <div class="form-group">
                                <label>Текст обращения</label>
                                {{ Form::textarea('content', '', ['class' => 'form-control', 'required' => 'required']) }}
                            </div>

                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
