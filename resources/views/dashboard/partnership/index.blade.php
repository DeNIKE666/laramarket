@extends('layouts.admin')

@section('content')

    <div class="lcPageContentData">
        <div class="lcPageContentData__title">
            Реферная ссылка для регисрации
        </div>
        <br><br>
        <textarea style="height: 80px; line-height: 1.3; padding: 5px" class="form-control"
                  onfocus="this.select();"
                  readonly="readonly">{{ route('register_referral', auth()->user()->partner_token) }}</textarea>

    </div>

@endsection
