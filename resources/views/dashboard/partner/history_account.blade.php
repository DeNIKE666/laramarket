@php
    /** @var \Illuminate\Support\Collection $history */
    /** @var \App\Models\PartnerAsAloneHistoryAccount $historyItem */
@endphp

@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <div class="lcPageContentData__title" style="margin-bottom: 2rem;">
            @lang('partner/history_account.title')
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
                    Сумма
                </div>
                <div class="lcPageContentCol">
                    Процент
                </div>
                <div class="lcPageContentCol">
                    Дата
                </div>
            </div>

            @foreach($history as $historyItem)
                <div class="lcPageContentRow">
                    <div class="lcPageContentCol">
                        {{ $loop->iteration }}
                    </div>
                    <div class="lcPageContentCol">
                        {{ getName($historyItem->sender) }}
                    </div>
                    <div class="lcPageContentCol">
                        {!! formatByCurrency($historyItem->amount, 2) !!}
                    </div>
                    <div class="lcPageContentCol">
                        {{ $historyItem->percent }}%
                    </div>
                    <div class="lcPageContentCol">
                        {{ \Illuminate\Support\Carbon::parse($historyItem->created_at)->format('d.m.Y H:i') }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection