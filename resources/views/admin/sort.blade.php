@extends('layouts.app')

@section('content')

<div class="mt">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
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
                <tr>
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
                        data-target="#testModal3"
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
                @include('modal.admin')
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>

@endsection
