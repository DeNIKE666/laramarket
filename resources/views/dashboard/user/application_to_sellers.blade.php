@php
    /** @var \App\Models\User $user */
@endphp

@extends('layouts.admin')

@section('content')
    @can('is-buyer', $user)
        <div class="userReg">
            <div class="userRegTop">
                <div class="lcPageContentSort__item">
                    <span>
                    Выберите форму регистрации:
                    </span>
                    <div class="catalogTop__sort">
                        <div class="catalogSort userRegTopSort">
                            <span name="1">Физическое лицо</span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="12px" height="6px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
                                      d="M-0.000,-0.000 L12.000,-0.000 L6.000,6.000 L-0.000,-0.000 Z"/>
                            </svg>
                            <div class="catalogSort__drop">
                                <span name="2">
                                ИП
                                </span>
                                <span name="3">
                                ООО
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div name="1" class="userRegContent userRegContent-active">

                {{ Form::open(['route' => [ 'user.store-application-to-seller'], 'method' => 'post', 'class' => 'forms-sample']) }}
                {{ Form::hidden('type_shop', $user::TYPE1) }}
                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>Ф.И.О.</span>
                        {{ Form::text('name', getName($user), ['placeholder' => 'Введите Ф.И.О.', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Гражданство</span>
                        {{ Form::text('citizenship', $property->citizenship, ['placeholder' => 'Введите гражданство', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>Телефон</span>
                        {{ Form::text('phone', $property->phone, ['placeholder' => 'Ваш телефон', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Серия и номер паспорта</span>
                        {{ Form::text('passport_number', $property->passport_number, ['placeholder' => 'Ведите данные', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Кем и когда выдан</span>
                        {{ Form::text('passport_issued', $property->passport_issued, ['placeholder' => 'Ф.М.С.', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>Адрес прописки</span>
                        {{ Form::text('address', $property->address, ['placeholder' => 'Индекс, город, уллица', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp userRegInp-photo">
                        <span>Прикрепить документы <span>(Фото)</span></span>
                        <label for="file-upload">
                            <input name="files" id="file-upload" multiple  type="file"  placeholder="Паспорта и прописки">
                            <span>Паспорта и прописки</span>
                        </label>
                        <button class="btn">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="22px" height="25px">
                                <path fill-rule="evenodd"  fill="rgb(35, 35, 35)"
                                      d="M21.712,9.718 C21.330,9.328 20.713,9.330 20.333,9.722 L8.608,21.808 C7.087,23.368 4.617,23.368 3.093,21.806 C1.570,20.244 1.570,17.711 3.093,16.149 L15.164,3.707 C16.114,2.733 17.658,2.733 18.610,3.709 C19.563,4.685 19.563,6.268 18.610,7.245 L8.610,17.498 C8.609,17.499 8.609,17.499 8.608,17.500 C8.227,17.889 7.612,17.888 7.231,17.498 C6.850,17.108 6.850,16.475 7.231,16.084 L12.058,11.134 C12.439,10.744 12.439,10.110 12.058,9.720 C11.677,9.329 11.060,9.329 10.679,9.720 L5.852,14.670 C4.709,15.842 4.709,17.741 5.852,18.912 C6.995,20.084 8.847,20.084 9.990,18.912 C9.991,18.911 9.992,18.910 9.993,18.908 L19.990,8.659 C21.704,6.901 21.704,4.052 19.990,2.294 C18.275,0.538 15.496,0.538 13.783,2.294 L1.712,14.737 C-0.571,17.078 -0.571,20.877 1.713,23.220 C3.999,25.563 7.705,25.563 9.989,23.220 L21.716,11.132 C22.096,10.741 22.094,10.107 21.712,9.718 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="userRegBottom">
                    <button class="userRegBottom__btn btn" type="submit">
                        Отправить заявку
                    </button>
                    <div class="userRegBottom__inf">
                        Спасибо за Вашу заявку. Ваши данные будут проверены менеджером. Ожидайте уведомления на e-mail
                    </div>
                </div>
                {{ Form::close() }}
            </div>

            <div name="2" class="userRegContent">
                {{ Form::open(['route' => ['user.store-application-to-seller'], 'method' => 'post', 'class' => 'forms-sample']) }}
                {{ Form::hidden('type_shop', $user::TYPE2) }}
                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>Ф.И.О.</span>
                        {{ Form::text('name', getName($user), ['placeholder' => 'Введите Ф.И.О.', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Гражданство</span>
                        {{ Form::text('citizenship', $property->citizenship, ['placeholder' => 'Введите гражданство', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>Телефон</span>
                        {{ Form::text('phone', $property->phone, ['placeholder' => 'Ваш телефон', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Серия и номер паспорта</span>
                        {{ Form::text('passport_number', $property->passport_number, ['placeholder' => 'Ведите данные', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Кем и когда выдан</span>
                        {{ Form::text('passport_issued', $property->passport_issued, ['placeholder' => 'Ф.М.С.', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>ИНН</span>
                        {{ Form::text('inn', $property->inn, ['placeholder' => 'ИНН', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>ОГРНИП</span>
                        {{ Form::text('ogrnip', $property->ogrnip, ['placeholder' => 'ОГРНИП', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Адрес прописки</span>
                        {{ Form::text('address', $property->address, ['placeholder' => 'Адрес прописки', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>Юридический адрес</span>
                        {{ Form::text('ur_address', $property->ur_address, ['placeholder' => 'Юридический адрес', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Форма налогообложения</span>
                        {{ Form::text('form_of_taxation', $property->form_of_taxation, ['placeholder' => 'Форма налогообложения', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Банк</span>
                        {{ Form::text('bank', $property->bank, ['placeholder' => 'Банк', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>БИК</span>
                        {{ Form::text('bik', $property->bik, ['placeholder' => 'БИК', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>р/с</span>
                        {{ Form::text('rs', $property->rs, ['placeholder' => 'р/с', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>к/с</span>
                        {{ Form::text('ks', $property->ks, ['placeholder' => 'к/с', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp userRegInp-photo">
                        <span>Прикрепить документы <span>(Фото)</span></span>
                        <label for="file-upload">
                            <input name="ашдуы" id="file-upload" multiple  type="file"  placeholder="Паспорта и прописки">
                            <span>Паспорта и прописки</span>
                        </label>
                        <button class="btn">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="22px" height="25px">
                                <path fill-rule="evenodd"  fill="rgb(35, 35, 35)"
                                      d="M21.712,9.718 C21.330,9.328 20.713,9.330 20.333,9.722 L8.608,21.808 C7.087,23.368 4.617,23.368 3.093,21.806 C1.570,20.244 1.570,17.711 3.093,16.149 L15.164,3.707 C16.114,2.733 17.658,2.733 18.610,3.709 C19.563,4.685 19.563,6.268 18.610,7.245 L8.610,17.498 C8.609,17.499 8.609,17.499 8.608,17.500 C8.227,17.889 7.612,17.888 7.231,17.498 C6.850,17.108 6.850,16.475 7.231,16.084 L12.058,11.134 C12.439,10.744 12.439,10.110 12.058,9.720 C11.677,9.329 11.060,9.329 10.679,9.720 L5.852,14.670 C4.709,15.842 4.709,17.741 5.852,18.912 C6.995,20.084 8.847,20.084 9.990,18.912 C9.991,18.911 9.992,18.910 9.993,18.908 L19.990,8.659 C21.704,6.901 21.704,4.052 19.990,2.294 C18.275,0.538 15.496,0.538 13.783,2.294 L1.712,14.737 C-0.571,17.078 -0.571,20.877 1.713,23.220 C3.999,25.563 7.705,25.563 9.989,23.220 L21.716,11.132 C22.096,10.741 22.094,10.107 21.712,9.718 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="userRegBottom">
                    <button class="userRegBottom__btn btn" type="submit">
                        Отправить заявку
                    </button>
                    <div class="userRegBottom__inf">
                        Спасибо за Вашу заявку. Ваши данные будут проверены менеджером. Ожидайте уведомления на e-mail
                    </div>
                </div>

                {{ Form::close() }}
            </div>

            <div name="3" class="userRegContent">
                {{ Form::open(['route' => ['user.store-application-to-seller'], 'method' => 'post', 'class' => 'forms-sample']) }}
                {{ Form::hidden('type_shop', $user::TYPE3) }}

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>Ф.И.О.</span>
                        {{ Form::text('name', getName($user), ['placeholder' => 'Введите Ф.И.О.', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Гражданство</span>
                        {{ Form::text('citizenship', $property->citizenship, ['placeholder' => 'Введите гражданство', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>Телефон</span>
                        {{ Form::text('phone', $property->phone, ['placeholder' => 'Ваш телефон', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Серия и номер паспорта</span>
                        {{ Form::text('passport_number', $property->passport_number, ['placeholder' => 'Ведите данные', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Кем и когда выдан</span>
                        {{ Form::text('passport_issued', $property->passport_issued, ['placeholder' => 'Ф.М.С.', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>Полное наименование предприятия</span>
                        {{ Form::text('name_company', $property->name_company, ['placeholder' => 'Полное наименование предприятия', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>ФИО директора</span>
                        {{ Form::text('fio_director', $property->fio_director, ['placeholder' => 'ФИО директора', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>ИНН</span>
                        {{ Form::text('inn', $property->inn, ['placeholder' => 'ИНН', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>КПП</span>
                        {{ Form::text('kpp', $property->kpp, ['placeholder' => 'КПП', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>ОГРН</span>
                        {{ Form::text('ogrn', $property->ogrn, ['placeholder' => 'ОГРН', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Почтовый адрес</span>
                        {{ Form::text('address', $property->address, ['placeholder' => 'Почтовый адрес', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>Юридический адрес</span>
                        {{ Form::text('ur_address', $property->ur_address, ['placeholder' => 'Юридический адрес', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Форма налогообложения</span>
                        {{ Form::text('form_of_taxation', $property->form_of_taxation, ['placeholder' => 'Форма налогообложения', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>Банк</span>
                        {{ Form::text('bank', $property->bank, ['placeholder' => 'Почтовый адрес', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp">
                        <span>БИК</span>
                        {{ Form::text('bik', $property->bik, ['placeholder' => 'БИК', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>р/с</span>
                        {{ Form::text('rs', $property->rs, ['placeholder' => 'р/с', 'required' => 'required']) }}
                    </div>
                    <div class="userRegInp">
                        <span>к/с</span>
                        {{ Form::text('ks', $property->ks, ['placeholder' => 'к/с', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="userRegRow">
                    <div class="userRegInp userRegInp-photo">
                        <span>Прикрепить документы <span>(Фото)</span></span>
                        <label for="file-upload">
                            <input name="ашдуы" id="file-upload" multiple  type="file"  placeholder="Паспорта и прописки">
                            <span>Паспорта и прописки</span>
                        </label>
                        <button class="btn">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="22px" height="25px">
                                <path fill-rule="evenodd"  fill="rgb(35, 35, 35)"
                                      d="M21.712,9.718 C21.330,9.328 20.713,9.330 20.333,9.722 L8.608,21.808 C7.087,23.368 4.617,23.368 3.093,21.806 C1.570,20.244 1.570,17.711 3.093,16.149 L15.164,3.707 C16.114,2.733 17.658,2.733 18.610,3.709 C19.563,4.685 19.563,6.268 18.610,7.245 L8.610,17.498 C8.609,17.499 8.609,17.499 8.608,17.500 C8.227,17.889 7.612,17.888 7.231,17.498 C6.850,17.108 6.850,16.475 7.231,16.084 L12.058,11.134 C12.439,10.744 12.439,10.110 12.058,9.720 C11.677,9.329 11.060,9.329 10.679,9.720 L5.852,14.670 C4.709,15.842 4.709,17.741 5.852,18.912 C6.995,20.084 8.847,20.084 9.990,18.912 C9.991,18.911 9.992,18.910 9.993,18.908 L19.990,8.659 C21.704,6.901 21.704,4.052 19.990,2.294 C18.275,0.538 15.496,0.538 13.783,2.294 L1.712,14.737 C-0.571,17.078 -0.571,20.877 1.713,23.220 C3.999,25.563 7.705,25.563 9.989,23.220 L21.716,11.132 C22.096,10.741 22.094,10.107 21.712,9.718 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="userRegBottom">
                    <button class="userRegBottom__btn btn" type="submit">
                        Отправить заявку
                    </button>
                    <div class="userRegBottom__inf">
                        Спасибо за Вашу заявку. Ваши данные будут проверены менеджером. Ожидайте уведомления на e-mail
                    </div>
                </div>

                {{ Form::close() }}
            </div>


    @endcan
@endsection
