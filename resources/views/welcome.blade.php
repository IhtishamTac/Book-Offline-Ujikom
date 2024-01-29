<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Home - {{ auth()->user()->name }}</title>
</head>

<body>
    @include('layout.nav')
    <div class="container mt-5" style="padding-bottom: 100px;">
        <div class="d-flex justify-content-between">
            <h2>Pilih buku yang akan dipesan</h2>
            @if (Session::has('message'))
                <span class="alert alert-success">
                    {{ Session::get('message') }}
                </span>
            @endif
        </div>
        <div class="mt-4">
            <div class="row">
                @foreach ($books as $book)
                    <div class="col-2 mt-3">
                        <img src="{{ asset($book->sampul_buku) }}" width="100px" alt="sampul" class="card-img-top">
                    </div>
                    <div class="col-4 p-3 mt-3 mb-auto" style="background-color: rgb(235, 235, 235);">
                        <div class="d-flex justify-content-between">
                            <h3>{{ $book->judul_buku }}</h3>
                            <p style="margin-top: 5px;">Stok : <span style="color: red; font-weight: 500;">{{ $book->stok }}</span></p>
                        </div>
                        <p>{{ $book->deskripsi }}</p>
                        <form action="{{ route('post-keranjang', $book->id) }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-between mt-2 mb-2">
                                <p style="margin-top: 4px;">Jumlah</p>
                                <input type="number" value="1" min="1" name="qty" style="height: 35px;"
                                    class="form-control w-50">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-success" style="border-radius: 2px;">
                                    Masukan keranjang
                                </button>
                                <h5 style="margin-top: 4px;">Rp. {{ number_format($book->harga_buku, 2, ',', '.') }}</h5>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
