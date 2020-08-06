@extends('layouts.admin')

@section('content')
    @can('role-user', $user)
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Заявка на продовца</h4>
                        <br>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="type1-tab" data-toggle="tab" href="#type1" role="tab" aria-controls="type1" aria-selected="true">Физическое лицо</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="type2-tab" data-toggle="tab" href="#type2" role="tab" aria-controls="type2" aria-selected="false">Индивидуальный предприниматель</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="type3-tab" data-toggle="tab" href="#type3" role="tab" aria-controls="type3" aria-selected="false">Представитель кампании</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="type1" role="tabpanel" aria-labelledby="type1-tab">
                                {{ Form::open(['route' => [ 'request_application_to_sellers'], 'method' => 'put', 'class' => 'forms-sample']) }}
                                {{ Form::hidden('type_shop', $user->getType1()) }}
                                <div class="form-group mt-5">
                                    <label>ФИО</label>
                                    {{ Form::text('name', $user->name, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Гражданство</label>
                                    {{ Form::text('citizenship', $property->citizenship, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Телефон</label>
                                    {{ Form::text('phone', $property->phone, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Серия и номер паспорта</label>
                                    {{ Form::text('passport_number', $property->passport_number, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>кем выдан паспорт</label>
                                    {{ Form::text('passport_issued', $property->passport_issued, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Адрес прописки</label>
                                    {{ Form::text('address', $property->address, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Документы</label>

                                </div>
                                <button type="submit" class="btn btn-primary">Отправить</button>
                                {{ Form::close() }}
                            </div>
                            <div class="tab-pane" id="type2" role="tabpanel" aria-labelledby="type2-tab">
                                {{ Form::open(['route' => [ 'request_application_to_sellers'], 'method' => 'put', 'class' => 'forms-sample']) }}
                                {{ Form::hidden('type_shop', $user->getType2()) }}
                                <div class="form-group mt-5">
                                    <label>ФИО</label>
                                    {{ Form::text('name', $user->name, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Гражданство</label>
                                    {{ Form::text('citizenship', $property->citizenship, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Телефон</label>
                                    {{ Form::text('phone', $property->phone, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Серия и номер паспорта</label>
                                    {{ Form::text('passport_number', $property->passport_number, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Кем выдан паспорт</label>
                                    {{ Form::text('passport_issued', $property->passport_issued, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>ИНН</label>
                                    {{ Form::text('inn', $property->inn, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>ОГРНИП</label>
                                    {{ Form::text('ogrnip', $property->ogrnip, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Адрес прописки</label>
                                    {{ Form::text('address', $property->address, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Юридический адрес</label>
                                    {{ Form::text('ur_address', $property->ur_address, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Форма налогообложения</label>
                                    {{ Form::text('form_of_taxation', $property->form_of_taxation, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Банк</label>
                                    {{ Form::text('bank', $property->bank, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>БИК</label>
                                    {{ Form::text('bik', $property->bik, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>р/с</label>
                                    {{ Form::text('rs', $property->rs, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>к/с</label>
                                    {{ Form::text('ks', $property->ks, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Документы</label>

                                </div>
                                <button type="submit" class="btn btn-primary">Отправить</button>
                                {{ Form::close() }}
                            </div>
                            <div class="tab-pane" id="type3" role="tabpanel" aria-labelledby="type3-tab">
                                {{ Form::open(['route' => [ 'request_application_to_sellers'], 'method' => 'put', 'class' => 'forms-sample']) }}
                                {{ Form::hidden('type_shop', $user->getType3()) }}
                                <div class="form-group mt-5">
                                    <label>ФИО</label>
                                    {{ Form::text('name', $user->name, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Гражданство</label>
                                    {{ Form::text('citizenship', $property->citizenship, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Телефон</label>
                                    {{ Form::text('phone', $property->phone, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Серия и номер паспорта</label>
                                    {{ Form::text('passport_number', $property->passport_number, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Кем выдан паспорт</label>
                                    {{ Form::text('passport_issued', $property->passport_issued, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Полное наименование предприятия</label>
                                    {{ Form::text('name_company', $property->name_company, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>ФИО директора</label>
                                    {{ Form::text('fio_director', $property->fio_director, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>ИНН</label>
                                    {{ Form::text('inn', $property->inn, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>КПП</label>
                                    {{ Form::text('kpp', $property->kpp, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>ОГРН</label>
                                    {{ Form::text('ogrn', $property->ogrn, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Почтовый адрес</label>
                                    {{ Form::text('address', $property->address, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Юридический адрес</label>
                                    {{ Form::text('ur_address', $property->ur_address, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Форма налогообложения</label>
                                    {{ Form::text('form_of_taxation', $property->form_of_taxation, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Банк</label>
                                    {{ Form::text('bank', $property->bank, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>БИК</label>
                                    {{ Form::text('bik', $property->bik, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>р/с</label>
                                    {{ Form::text('rs', $property->rs, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>к/с</label>
                                    {{ Form::text('ks', $property->ks, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    <label>Документы</label>

                                </div>
                                <button type="submit" class="btn btn-primary">Отправить</button>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endcan
@endsection
