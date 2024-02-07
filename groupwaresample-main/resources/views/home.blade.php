@extends('layouts.common')

@push('script')
<script>
    const loginUser = @json(Auth::user())
</script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src="{{ asset('js/commons/home.js') }}"></script>
@endpush

@section('content')
<div id="app">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div id="calendar"></div>
        </div>
    </div>
    <div id="modal-regist" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span class="material-symbols-outlined">calendar_month</span>
                        @{{ selectedDate }}のスケジュール</h5>
                </div>
                <div class="modal-body">
                    <form id="form-regist">
                        <div class="mb-3 form-check">
                            <input v-model="scheduleParams.allDay" type="checkbox" class="form-check-input" id="allDay">
                            <label class="form-check-label" for="allDay">終日</label>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="startTime" class="form-label" :class="{'text-muted': scheduleParams.allDay}">
                                        <span class="material-symbols-outlined">schedule</span>
                                        開始時間
                                    </label>
                                    <input v-model="scheduleParams.start" type="time" class="form-control" id="startTime" :disabled="scheduleParams.allDay">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="endTime" class="form-label" :class="{'text-muted': scheduleParams.allDay}">
                                        <span class="material-symbols-outlined">schedule</span>
                                        終了時間
                                    </label>
                                    <input v-model="scheduleParams.end" type="time" class="form-control" id="endTime" :disabled="scheduleParams.allDay">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="scheduleTitle" class="form-label">
                                <span class="material-symbols-outlined">create</span>
                                スケジュールタイトル</label>
                            <input v-model="scheduleParams.title" type="text" class="form-control" id="scheduleTitle" placeholder="スケジュールタイトルを入力">
                        </div>
                        <div class="mb-3">
                            <label for="scheduleDetails" class="form-label">
                                <span class="material-symbols-outlined">create</span>
                                スケジュール詳細
                            </label>
                            <textarea v-model="scheduleParams.description" class="form-control" id="scheduleDetails" rows="3" placeholder="スケジュール詳細を入力"></textarea>
                        </div>
                        <div class="md-3">
                            <label for="scheduleTitle" class="form-label">
                                <span class="material-symbols-outlined">create</span>
                                対象ユーザー
                            </label>
                            <div>
                                @foreach($users as $user)
                                    <input v-model="selectedUsers" value="{{ $user->id }}" type="checkbox" class="btn-check" id="check-user-{{ $user->id }}" autocomplete="off">
                                    <label class="btn btn-outline-success mb-3 me-3" for="check-user-{{ $user->id }}">{{ $user->name }}</label>
                                @endforeach
                            </div>
                        </div>
                        <button v-on:click="executeDelete" type="button" class="btn btn-danger" v-if="scheduleParams.id != ''">
                            <span class="material-symbols-outlined">delete</span>
                            削除
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <span class="material-symbols-outlined">cancel</span>
                        キャンセル
                    </button>
                    <button v-on:click="updateSchedule" type="button" class="btn btn-primary">
                        <span class="material-symbols-outlined">add_circle_outline</span>
                        スケジュールを保存する
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-detail" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span class="material-symbols-outlined">calendar_month</span>
                        @{{ selectedDate }}のスケジュール</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h2 class="h6 title">時間</h2>
                        <h4 v-if="scheduleParams.allDay" class="m-1">
                            <span class="badge bg-danger">終日</span>
                        </h4>
                        <p class="p-1" v-else>
                            @{{ scheduleParams.start }} ～ @{{ scheduleParams.end }}
                        </p>
                    </div>
                    <div class="mb-3">
                        <h2 class="h6 title">スケジュールタイトル</h2>
                        <p class="p-1">
                            @{{ scheduleParams.title }}
                        </p>
                    </div>
                    <div class="mb-3">
                        <h2 class="h6 title">スケジュール詳細</h2>
                        <p class="p-1">
                            @{{ scheduleParams.description }}
                        </p>
                    </div>
                    <div class="mb-3">
                        <h2 class="h6 title">メンバー</h2>
                        <p class="p-1">
                            <span class="me-1" v-for="member in selectedUserNames">@{{ member }}</span>
                        </p>
                    </div>
                    <div class="mb-3">
                        <h2 class="h6 title">登録者</h2>
                        <p class="p-1">
                            @{{ scheduleParams.register?.name }}
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <span class="material-symbols-outlined">cancel</span>
                        閉じる
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
