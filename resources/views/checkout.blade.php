<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Checkout - {{auth()->user()->name}}</title>
</head>
<body>
    @php
        $totalSemua = 0;

        foreach ($transaksi as $item) {
            $hargaAwal = $item->book->harga_buku * $item->qty;
            $totalSemua += $hargaAwal;
        }

    @endphp
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <form action="{{ route('postcheckout', ['tranID' => json_encode($transaksi->pluck('id'))] ) }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <h3>Checkout Barang Anda</h3>
                        <div class="d-flex">
                            <p style="margin-top: 10px; font-size: large;">Total Semua Buku :  <span style="font-weight: 500; margin-right: 10px;">Rp. {{ number_format($totalSemua, 2, ',','.') }}</span></p>
                            <button id="btnCheckout" style="background-color: blue; border-radius: 2px; width: 100px;font-size: large;" class="btn text-white" disabled>Bayar</button>
                        </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-between">
                            <input type="text" class="form-control w-50" name="uang_dibayarkan" placeholder="Uang dibayarkan..." id="uangDibayarkan">
                            <p >Uang Kembalian : <span style="font-weight: 500" id="uangKembali">Rp. 0</span></p>
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control" placeholder="Nama Pembeli" name="nama_pembeli" required>
                        </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table" >
                    <thead>
                       <tr>
                        <th>
                            Gambar Barang
                        </th>
                        <th>
                            Nama Barang
                        </th>
                        <th>
                            Harga Barang
                        </th>
                        <th>
                            Jumlah Barang
                        </th>
                        <th>
                            Total Harga
                        </th>
                        <th>
                            Aksi
                        </th>
                       </tr>
                    </thead>
                    <tbody>
                       @foreach ($transaksi as $item)
                       <tr>
                        <td>
                            <img src="{{ asset($item->book->sampul_buku) }}" style="width: 70px" alt="">
                        </td>
                        <td>
                            {{ $item->book->judul_buku }}
                        </td>
                        <td>
                            Rp. {{  number_format($item->book->harga_buku,2,',','.') }};
                        </td>
                        <td>
                            {{ $item->qty }}
                        </td>
                        <td>
                            Rp. {{  number_format($item->book->harga_buku * $item->qty,2,',','.') }};
                        </td>
                        <td>
                            <a href="" style="border-radius: 2px;" class="btn btn-danger">
                                Hapus
                            </a>
                        </td>
                    </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var input = document.getElementById('uangDibayarkan');
            var lblKembali = document.getElementById('uangKembali');
            var btnCheckout = document.getElementById('btnCheckout');

            input.addEventListener('input', (()=>{
                var uangDibayarkan = parseInt(input.value) || 0;
                var kembali = uangDibayarkan - {{ $totalSemua }};

                if (uangDibayarkan < {{ $totalSemua }}) {
                    lblKembali.textContent = "Uang tidak cukup";
                    btnCheckout.disabled = true; 
                } else {
                    lblKembali.textContent = 'Rp. ' + kembali.toFixed(2);
                    btnCheckout.disabled = false;
                }

            }));
        });
    </script>
</body>
</html>
