<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Pustakawan',
            'email' => 'pustakawan@gmail.com',
            'username' => 'pusta',
            'password' => bcrypt('pusta'),
            'role' => 'pustakawan'
        ]);

        Book::create([
            'sampul_buku' => 'book_image/Bumi_(sampul).jpg',
            'judul_buku' => 'Bumi',
            'deskripsi' => 'Seri pertama dari novel karya Tere Liye',
            'pengarang_buku' => 'Tere Liye',
            'harga_buku' => 95000,
            'stok' => 100
        ]);
        Book::create([
            'sampul_buku' => 'book_image/bulan_(sampul).jpg',
            'judul_buku' => 'Bulan',
            'deskripsi' => 'Seri kedua dari novel karya Tere Liye',
            'pengarang_buku' => 'Tere Liye',
            'harga_buku' => 95000,
            'stok' => 100
        ]);
        Book::create([
            'sampul_buku' => 'book_image/bintang_sampul.jpg',
            'judul_buku' => 'Bintang',
            'deskripsi' => 'Seri ke 4 dari novel karya Tere Liye',
            'pengarang_buku' => 'Tere Liye',
            'harga_buku' => 95000,
            'stok' => 100
        ]);
    }
}
