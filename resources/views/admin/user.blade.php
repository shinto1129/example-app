@extends('layouts.app')

@section('content')

<div class="mt">
    <h1>非常勤講師一覧</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メールアドレス</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $key => $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td><a href="/admin/user/{{ $u->id }}">{{ $u->name }}</a></td>
                    <td>{{ $u->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
