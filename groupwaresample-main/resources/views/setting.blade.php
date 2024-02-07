@extends('layouts.common')

@section('title', '個人設定')

@push('script')
    <script>
        const loginUser = @json(Auth::user())
    </script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src="{{ asset('js/commons/home.js') }}"></script>
@endpush

@section('content')
<div id="app">
    <div class="row justify-content-center mt-3">
        <div class="col-lg-8">
            <h2 class="title">カレンダー設定</h2>
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{ route('setting') }}" method="POST">
                <div class="mb-3">
                    <label for="calendarBackground" class="form-label">カレンダー帯 背景色</label>
                    <div>
                        <input type="color" name="calendar_background" class="" value="{{ Auth::user()->calendar_background }}" id="calendarBackground" title="色を選択してください">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="calendarBorderColor" class="form-label">カレンダー帯 枠色</label>
                    <div>
                        <input type="color" name="calender_bordercolor" class="" value="{{ Auth::user()->calender_bordercolor }}" id="calendarBorderColor" title="色を選択してください">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="calendarTextColor" class="form-label">カレンダー帯 文字色</label>
                    <div>
                        <input type="color" name="calendar_textcolor" class="" value="{{ Auth::user()->calendar_textcolor }}" id="calendarTextColor" title="色を選択してください">
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-outlined">save</span>
                        更新する
                    </button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
