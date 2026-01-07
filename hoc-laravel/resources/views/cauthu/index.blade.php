@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Danh sách cầu thủ</h2>

    <a href="/cauthu/create">+ Thêm cầu thủ</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Tuổi</th>
            <th>Lương</th>3123vccv
            <th>Hành động</th>
        </tr>

        @foreach ($cauthu as $player)
        <tr>
            <td>{{ $player->id }}</td>
            <td>{{ $player->name }}</td>
            <td>{{ $player->age }}</td>
            <td>{{ number_format($player->salary) }} đ</td>
            <td>
                <a href="{{url ('/cauthu/edit/'.$player->id)}}">Sửa</a>
                <a href="{{url ('/cauthu/delete/'.$player->id)}}">delete</a>


                <!-- <form action="/cauthu/delete/{{ $player->id }}"
                      method="GET"
                      style="display:inline"
                      onsubmit="return confirm('Xóa cầu thủ này?')">
                    <button type="submit">Xóa</button>
                </form> -->
            </td>
            <td>
                @if ($player->image)
                    <img src="{{ asset('uploads/cauthu/'.$player->image) }}"
                        width="80">
                @else
                    Chưa có hình
                @endif
            </td>

        </tr>
        @endforeach
    </table>
</div>
@endsection
