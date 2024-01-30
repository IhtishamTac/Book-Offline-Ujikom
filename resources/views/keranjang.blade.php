<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Keranjang - {{ auth()->user()->name }}</title>
</head>

<body>
    @include('layout.nav')
    @php
        
    @endphp
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h5>Klik checkout untuk membayar semua buku dalam keranjang</h4>
                
                @if ($trans->count() > 0)
                    <a href="{{route('checkout', ['tranID' => json_encode($trans->pluck('id'))]) }}" class="btn btn-primary" style="border-radius: 2px">Checkout</a>
                @endif
        </div>
        <div class="mt-3">
            <div class="row">
                @if (Session::has('message'))
                <span class="alert alert-success">
                    {{ Session::get('message') }}
                </span>
            @endif
                <div class="d-flex justify-content-end">
                    <p style="margin-right: 10px; margin-top: 10px;">Cari Buku anda : </p>
                    <form action="{{ route('caribuku') }}">
                        <input type="search" placeholder="Cari..." oninput="this.form.submit()" name="cariTransaksi" class="form-control">
                    </form>
                </div>
                @foreach ($trans as $trn)
                <div class="col-2 mt-3">
                    <img src="{{ asset($trn->book->sampul_buku) }}" alt="sampul" class="card-img-top">
                </div>
                <div class="col-4 mt-3">
                    <div class="d-flex justify-content-between">
                        <h3>{{ $trn->book->judul_buku }}</h3>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <p>Harga barang : </p>
                            <p style="font-weight: 500">Rp. {{ number_format($trn->book->harga_buku, 2, ',','.') }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Jumlah : </p>
                            <p style="font-weight: 500">{{ $trn->qty }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Total : </p>
                            <p style="font-weight: 500">Rp. {{ number_format($trn->book->harga_buku * $trn->qty,2,',','.') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('hapuskeranjang', $trn->id) }}" class="btn btn-danger" style="border-radius: 2px;">Batalkan</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
