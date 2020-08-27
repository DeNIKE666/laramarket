@extends('layouts.admin')

@section('content')


    {{ Form::open(['route' => [ 'admin.payment_option.store'], 'method' => 'post', 'class' => 'forms-sample']) }}
    <div class="lcPageAddContent">
        <div class="lcPageContentData__title">
            Платёжная система
        </div>
        <br><br>
        <div class="lcPageAddContentToggle lcPageAddInps">
            <div class="lcPageAddInp">
                    <span>
                        Название
                    </span>
                {{ Form::text('title', '', ['class' => 'form-control', 'required' => 'required']) }}
                @if ($errors->has('title'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                @endif
            </div>
            <div class="lcPageAddInp">
                    <span>
                        Иконка
                    </span>
                {{ Form::text('ico', '', ['class' => 'form-control', 'required' => 'required']) }}
                @if ($errors->has('ico'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('ico') }}</strong></span>
                @endif
            </div>
            <div class="lcPageAddInp">
                    <span>
                        Последовательность
                    </span>
                {{ Form::text('sort', '', ['class' => 'form-control', 'required' => 'required']) }}
                @if ($errors->has('sort'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('sort') }}</strong></span>
                @endif
            </div>
        </div>
        <div class="lcPageAddContentToggle lcPageAddInps">
            <div class="lcPageAddInp">
                <label class="check-inp">
                    {{ Form::checkbox('is_filter', 1) }}

                    <span>Для поплнения счёта</span>
                </label>
            </div>
            <div class="lcPageAddInp">
                <label class="check-inp">
                    {{ Form::checkbox('is_withdrawal', 1) }}

                    <span>Для снятия</span>
                </label>
            </div>
        </div>
        <div class="lcPageAddContentToggle lcPageAddInps">
            <div class="lcPageAddInp">
                    <span>
                        Прцент пополнения
                    </span>
                {{ Form::text('depositeMoney', '', ['class' => 'form-control', 'required' => 'required']) }}
                @if ($errors->has('depositeMoney'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('depositeMoney') }}</strong></span>
                @endif
            </div>
            <div class="lcPageAddInp">
                    <span>
                        Процент снятия
                    </span>
                {{ Form::text('withdrawMoney', '', ['class' => 'form-control', 'required' => 'required']) }}
                @if ($errors->has('withdrawMoney'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('withdrawMoney') }}</strong></span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <button type="submit" style=" width: 200px" class="lcPageContentSort__btn btn">Сохранить</button>
        </div>
    </div>


    {{ Form::close() }}



@endsection