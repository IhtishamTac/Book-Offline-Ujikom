<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Log - {{auth()->user()->name}}</title>
</head>
<body>
    @include('layout.nav')
    <div class="container mt-5">
        <table class="table w-75 mx-auto">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama User</th>
                    <th>Aktivitas Yang Dilakukan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($log as $item)
                <tr>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->aktivitas }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
