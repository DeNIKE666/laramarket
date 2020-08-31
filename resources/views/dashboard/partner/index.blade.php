@php
    /** @var \App\Models\User $user */
    $user = auth()->user();
@endphp

@extends('layouts.admin')

@push('styles')
    <link type="text/css" href="{{ asset('css/common.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/dashboard/partner/transferToPersonalAccount.js') }}"></script>
@endpush

@section('content')
    <div id="popup-transferToPersonalAccount" class="popUp popUp-pay">
        <div class="popUp__content" style="justify-content: start; height: fit-content;">
            <div class="popUp__title">@lang('partner/index.popup.transfer_to_personal_account.title')</div>
            <div class="popUp__body" style="width: 100%;">
                {{ Form::open(['id' => 'form-transferToPersonalAccount']) }}
                <div class="error" id="transferToPersonalAccount_commonError" style="display: none; padding: 0 0 1rem 0; text-align: center;"></div>

                <div class="cardform__row">
                    <div class="cardform__row__col1">
                        <label for="transferToPersonalAccount_amount">@lang('partner/index.popup.transfer_to_personal_account.labels.amount')</label>
                        {{
                            Form::text(
                                '',
                                $user->partner_account,
                                [
                                    'id'    => 'transferToPersonalAccount_amount',
                                    'class' => 'input-card-full',
                                    'style' => 'margin-bottom: 0;'
                                ]
                            )
                         }}
                        <div class="error" style="display: none; padding: 10px 0;"></div>
                    </div>
                </div>
                <div class="cardform__row" style="margin-top: 20px;">
                    {{ Form::submit(__('partner/index.popup.transfer_to_personal_account.button'), ['class' => 'btn lcPageMenu__btn']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="popUp__layer"></div>
    </div>

    <div class="lcPageContentData">
        <div class="lcPageContentData__title" style="margin-bottom: 2rem;">
            @lang('partner/index.title')
        </div>

        <div>
            <div class="userRegInp userRegInp-photo" style="margin: 0; width: 100%;">
                {{
                    Form::text(
                        '',
                        route('join', $user->partner_token),
                        ['disabled' => 'disabled']
                    )
                }}

                {{
                    Form::button(
                        __('partner/index.button.copy_link'),
                        [
                            'class' => 'btn copy-partner-link',
                            'style' => 'width: 100px;',
                        ]
                    )
                }}
            </div>

            <div style="margin-top: 2rem; display: flex; flex-direction: row;">
                <div style="font-size: 2em; padding-top: 5px;">
                    {!! formatByCurrency($user->partner_account, 2) !!}
                </div>
                <div style="margin-left: 1rem;">
                    {{
                        Form::button(
                            __('partner/index.button.transfer_to_personal_account'),
                            [
                                'id'    => 'openForm-transferToPersonalAccount',
                                'class' => 'btn lcPageMenu__btn',
                                'style' => 'width: 100px;',
                            ]
                        )
                    }}
                </div>
            </div>
        </div>
    </div>

@endsection
