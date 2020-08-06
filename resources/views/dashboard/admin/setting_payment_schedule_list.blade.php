@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <h4 class="card-title">Настройка графика выплат </h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>min %</th>
                                    <th>max %</th>
                                    <th>ежемесячно</th>
                                    <th>квартал</th>
                                    <th>полгода</th>
                                    <th>единожды</th>
                                </tr>
                                </thead>
                                <tbody>
                                @each('dashboard.admin.block.item_setting_payment', $settings, 'setting')
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <h4 class="card-title">Добавить настройку</h4>
                            {{ Form::open(['route' => [ 'admin.setting_schedules.store'], 'method' => 'post', 'class' => 'forms-sample']) }}

                            <div class="form-group">
                                <label>min %</label>
                                {{ Form::number('min_percent', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>max %</label>
                                {{ Form::number('max_percent', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>Ежемесячно</label>
                                {{ Form::number('quantity_pay_every_month', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>В квартал</label>
                                {{ Form::number('quantity_pay_each_quarter', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>В полгода</label>
                                {{ Form::number('quantity_pay_every_six_months', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>Разова</label>
                                {{ Form::number('quantity_pay_single', '', ['class' => 'form-control']) }}
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
