<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>History - {{ auth()->user()->name }}</title>
</head>
<body>
    @include('layout.nav')
    <div class="container mt-5">
        <h2>History Pembelian</h2>
        <div class="row mt-5">
            @foreach ($transaksi as $item)
            <div class="col-6 mt-3">
                <div class="card">
                    <div class="d-flex">
                        <img src="{{ asset($item->book->sampul_buku) }}" style="width: 130px" alt="" class="card-img-top">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4>{{ $item->book->judul_buku }} <span>({{ $item->created_at }})</span></h4>
                            <p style="background-color: rgb(43, 67, 226); padding: 7px; border-radius: 2px;" class="text-white">INVdnub3rub </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Total Harga : </p>
                            <p style="font-weight: 500;">Rp. {{ number_format($item->total_semua,2,',','.') }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Nama Pembeli : </p>
                            <p style="font-weight: 500;">{{ $item->nama_pembeli }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Jumlah Beli : </p>
                            <p style="font-weight: 500;">{{ $item->qty }}</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>