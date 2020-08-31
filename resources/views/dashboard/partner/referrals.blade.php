@php
    /** @var \Illuminate\Support\Collection $referrals */
    /** @var \App\Models\User $referral */
@endphp

@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <div class="lcPageContentData__title" style="margin-bottom: 2rem;">
            @lang('partner/referrals.title')
        </div>

        <div class="lcPageContentTable">
            <div class="lcPageContentRow">
                <div class="lcPageContentCol">
                    №
                </div>
                <div class="lcPageContentCol">
                    Имя
                </div>
                <div class="lcPageContentCol">
                    Email
                </div>
                <div class="lcPageContentCol">
                    Телефон
                </div>
                <div class="lcPageContentCol">
                    Дата регистрации
                </div>
            </div>

            @foreach($referrals as $referral)
                <div class="lcPageContentRow">
                    <div class="lcPageContentCol">
                        {{ $loop->iteration }}
                    </div>
                    <div class="lcPageContentCol">
                        {{ getName($referral) }}
                    </div>
                    <div class="lcPageContentCol">
                        {{ $referral->email }}
                    </div>
                    <div class="lcPageContentCol">
                        {{ $referral->phone }}
                    </div>
                    <div class="lcPageContentCol">
                        {{ \Illuminate\Support\Carbon::parse($referral->created_at)->format('d.m.Y H:i') }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection