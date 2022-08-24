@extends('app')

@section('content')

<div class="mt">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @foreach ($data as $d)
        @if($d->check == 1)
            <div class="red">
                <a href="/admin/check">
                <h3>バッティングいている時間があります調整してください</h3>
                </a>
            </div>
            @break
        @endif
    @endforeach
    <h1>登録情報一覧</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>講師名</th>
                <th>曜日</th>
                <th>時限</th>
                <th>教室</th>
                <th>使用したい道具</th>
                <th>登録日時</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $d)
                <tr @if ($d->check != 0) class="red feled" @endif>
                    <td><a href="/admin/user/{{ $d->user_id }}">{{ $d->name }}</a>
                    <br>@if ($d->check != 0) バッティング中 @endif</td>
                    {{-- 曜日番号から日本語に変換 --}}
                    @switch($d->week)
                        @case(1)
                            <td>月曜日</td>
                            @break
                        @case(2)
                            <td>火曜日</td>
                            @break
                        @case(3)
                            <td>水曜日</td>
                            @break
                        @case(4)
                            <td>木曜日</td>
                            @break
                        @case(5)
                            <td>金曜日</td>
                            @break
                        @case(6)
                            <td>土曜日</td>
                            @break
                        @case(7)
                            <td>日曜日</td>
                            @break
                        @default
                            <td></td>

                    @endswitch
                    <td>{{ $d->period }}</td>
                    <td>{{ $d->rname }}</td>
                    <td>
                        {{-- 使用したい道具 --}}
                        @foreach ($items as $i)
                            @if ($i->register_id == $d->id)
                                {{ $i->name }}<br>
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $d->created_at }}</td>
                    <td>
                        <a id="select"
                        type="button"
                        data-toggle="modal"
                        data-target="#testModalx{{ $d->id }}"
                        data-period="{{ $d->period }}"
                        data-week="{{ $d->week }}"
                        @php
                            $itembox = 0;
                        @endphp
                        @foreach ($items as $i)
                            @php
                                $itembox++;
                            @endphp
                            @if ($i->register_id == $d->id)
                                data-item{{ $i->item_id }} = "{{ $i->item_id }}"
                            @endif
                        @endforeach
                        data-box="{{ $itembox }}">
                        編集</a>
                    </td>
                    <td><a href="">削除</a></td>
                </tr>
                @yield('adminModal')
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}


{{--

    <!-- ボタン・リンククリック後に表示される画面の内容 -->
    <div class="modal fade" id="testModal3" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">編集画面</h4></h4>
                </div>
                <form method="post" action="/roomRegister">
                    @csrf
                    <div class="row mb-3">
                        <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('曜日') }}</label>

                        <div class="col-md-6">
                            <select id="week-select" class="form-control" name='week' readonly>
                                <option value="1">月曜日</option>
                                <option value="2">火曜日</option>
                                <option value="3">水曜日</option>
                                <option value="4">木曜日</option>
                                <option value="5">金曜日</option>
                                <option value="6">土曜日</option>
                                <option value="7">日曜日</option>
                            </select>
                            @error('week')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="period" class="col-md-4 col-form-label text-md-end">{{ __('何限目') }}</label>

                        <div class="col-md-6">
                            <select id="period-select" class="form-control" name='period' readonly>
                                <option value="1">１限目</option>
                                <option value="2">２限目</option>
                                <option value="3">３限目</option>
                                <option value="4">４限目</option>
                                <option value="5">５限目</option>
                                <option value="6">６限目</option>
                            </select>
                            @error('period')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="room" class="col-md-4 col-form-label text-md-end">{{ __('教室') }}</label>

                        <div class="col-md-6">
                            <select id="room" class="form-control" name='room'>
                                @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                            </select>
                            @error('room')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="item" class="col-md-4 col-form-label text-md-end">{{ __('必要なもの') }}</label>

                        <div class="col-md-6">
                            @foreach ($itemData as $item)
                            <div>
                                <label for="checkbox{{ $item->id }}">{{ $item->name }}</label>
                                <input type="checkbox" id="checkbox{{ $item->id }}" name="item{{ $item->id }}" value="{{ $item->id }}" >
                            </div>
                            @endforeach
                            @error('item')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('登録') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    --}}
</div>

@endsection
