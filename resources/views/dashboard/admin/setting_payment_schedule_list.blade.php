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
                                    <th>Комиссия</th>
                                    <th>@lang('cashback/periods.0')</th>
                                    <th>@lang('cashback/periods.1')</th>
                                    <th>@lang('cashback/periods.2')</th>
                                    <th>@lang('cashback/periods.3')</th>
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
                                {{ Form::number('percent', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>@lang('cashback/periods.0')</label>
                                {{ Form::number('quantity_pay_every_month', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>@lang('cashback/periods.1')</label>
                                {{ Form::number('quantity_pay_each_quarter', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>@lang('cashback/periods.2')</label>
                                {{ Form::number('quantity_pay_every_six_months', '', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>@lang('cashback/periods.3')</label>
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
