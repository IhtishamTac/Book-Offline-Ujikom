<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Book;
use App\Models\Log;
use App\Models\Transaksi;
use Carbon\Carbon;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        return view('welcome', compact('books'));
    }

    public function log(){
        $log = Log::where('user_id', auth()->id())->with('user')->get();
        return view('log', compact('log'));
    }

    public function postkeranjang(Request $request, $id){
        $cekTransaksi = Transaksi::where(['user_id'=>auth()->id(), 'book_id' => $id, 'status' => 'Pending'])->first();
        if(!$cekTransaksi){
            Transaksi::create([
                'user_id' => auth()->id(),
                'book_id' => $id,
                'qty' => $request->qty,
                'status' => 'Pending'
            ]);
            return redirect()->back()->with('message', 'Dimasukan ke keranjang');

        }
       if($cekTransaksi){
        $cekTransaksi->qty = $cekTransaksi->qty + $request->qty;
        $cekTransaksi->save();
        return redirect()->back()->with('message', 'Dimasukan ke keranjang');

       }
    }
    public function keranjang(){
        $trans = Transaksi::where(['user_id' => auth()->id(), 'status' => 'Pending'])->with('book')->get();
        return view('keranjang', compact('trans'));
    }

    public function checkout($tranID){
        $transacId = json_decode($tranID);
        $transaksi = Transaksi::whereIn('id', $transacId)->where('status', 'Pending')->with('book')->get();
        return view('checkout', compact('transaksi'));
    }
    
    public function postcheckout(Request $request, $tranID){
        $request->validate([
            'uang_dibayarkan' => 'required',
            'nama_pembeli' => 'required',
        ]);
        $transacId = json_decode($tranID);
        $transaksi = Transaksi::whereIn('id', $transacId)->with('book')->get();

        $totalSemua = 0;

        foreach ($transaksi as $item) {
            $hargaAwal = $item->book->harga_buku * $item->qty;
            $totalSemua += $hargaAwal;

            $inv = 'INV' . Str::random(10);
            $item->invoice = $inv;
            $item->nama_pembeli = $request->nama_pembeli;
            $item->status = 'Dibayar';
            $item->total_semua = $totalSemua; 
            $item->uang_bayar = (int)$request->uang_dibayarkan;
            $item->uang_kembali = (int)$request->uang_dibayarkan - $totalSemua;
            $item->created_at = Carbon::now();
            $item->save();

            $book = Book::where('id', $item->book->id)->first();
            $book->stok -= $item->qty;
            $book->save();
        }

        Log::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Melakukan checkout untuk Pelanggan Bernama : ' . $request->nama_pembeli
        ]);

        return redirect()->route('home');
    }

    public function history() {
        $transaksi = Transaksi::where([
            'user_id' => auth()->id(),
            'status' => 'Dibayar'
        ])->get();

        return view('history-pembelian', compact('transaksi'));
    }
}
