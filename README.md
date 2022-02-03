# Moneytory v1.0

## Daftar Isi
- [Definisi](##definisi)
- [Proses Bisnis](##proses-bisnis)
- [Teknologi yang Digunakan](##teknologi-yang-digunakan)
- [Fitur yang Ditawarkan](##fitur-yang-ditawarkan)
- [Instalasi (Windows 10)](##instalasi-windows-10)

## Definisi
Moneytory adalah aplikasi berbasis website yang diperuntukan untuk oleh Usaha Mikro Kecil Menengah (UMKM) untuk mengelola inventory dan keuangan. Fitur-fitur yang ada di aplikasi ini seperti pengelolaan ketersediaan produk, pengelolaan informasi produk, pengelolaan pemasukan, pengelolaan pengeluaran, pengelolaan utang dan laporan keuangan. Aplikasi ini berbasis web dengan menggunakan framework Laravel.

## Proses Bisnis
Inventory & Money Management

## Teknologi yang Digunakan
- Bahasa Pemrograman: PHP v8.x
- Framework: Laravel v8.x
- Database: MySQL v8.x
- UI: Bootstrap v5.x

## Fitur yang Ditawarkan
- Pengelolaan Bahan Mentah
- Pengelolaan Bahan dalam Proses
- Pengelolaan Barang Jadi
- Pengelolaan Pemasukan / Order
- Pencarian Data Pemasukan Berdasarkan Produk Terjual
- Pengelolaan Pengeluaran
- Pengelolaan Hutang
- Laporan Keuangan (Pemasukan, Pengeluaran, dan Hutang)
- Pengaturan Profil Perusahaan
- Login & Logout
- Pengelolaan Pengguna (Admin dan Staff)
- Pengaturan Profil Pengguna

## Alur Penggunaan Fitur pada Aplikasi Moneytory

### Bahan Mentah
    1. Menambah bahan mentah
        1. Memilih menu liat bahan mentah
        2. menekan tombol tambah baru
        3. menambah bahan mentah baru dengan data seperti (nama, stok, stok_minimum, satuan, aktif, gambar), nama bahan mentah harus unik
    2. Melihat daftar bahan mentah
        1. Memilih menu lihat bahan mentah
        2. Akan muncul halaman yang menampilkan daftar bahan mentah
    3. Mengubah bahan mentah
        1. Memilih menu lihat bahan mentah
        2. Memilih salah satu bahan mentah yang ingin diubah datanya
        3. Mengubah data
        4. Menekan tombol konfirmasi ubah
        5. Data bahan mentah tsb berubah
    4. Menghapus bahan mentah
        1. Memilih menu lihat bahan mentah
        2. Menekan tombol hapus salah satu dari data bahan mentah yang ada
        3. Akan muncul popup konfirmasi 
        4. Jika yakin, maka tekan konfirmasi
    5. Mencari bahan mentah
        1. Memilih menu lihat bahan mentah
        2. Mengetikkan nama bahan mentah pada form pencarian
        3. Akan muncul data dalam daftar bahan jika ditemukan

### Bahan dalam Proses
    1. Menambah bahan dalam proses
        1. Pada form tambah bahan dalam proses, terdapat relasi dengan data pada tabel bahan mentah, saat menambahkan bahan dalam proses maka jumlah pada bahan mentah akan berkurang
        2. Memilih menu lihat bahan dalam proses
        3. Menekan tombol tambah bahan dalam proses
        4. Menambahkan data bahan dalam proses denan data seperti (untuk, id_bahan_mentah, jumlah, status (on process/done))
        5. Menekan tombol tambah bahan dalam proses
    2. Melihat daftar bahan dalam proses
        1. Memilih menu lihat bahan dalam proses
        2. Akan muncul daftar bahan dalam proses
    3. Mengubah bahan dalam proses
        1. Memilih menu lihat bahan dalam proses
        2. Menekan tombol ubah pada salah satu bahan dalam proses
        3. Mengubah datanya (jika jumlah bahan mentahnya nambah, maka di tabel bahan mentah akan dikurangi lagi, begitupun sebaliknya)
        4. Menekan tombol ubah
        5. Akan muncul popup konfirmasi
        6. Jika yakin maka tekan tombol konfirmasi
    4. Menghapus bahan dalam proses
        1. Memilih menu daftar bahan dalam proses
        2. Menghapus bahan dalam proses
        3. Bahan dalam proses yang dihapus, data jumlahnya akan kembali ditambahkan ke bahan mentah, jadi proses penghapusan ini disebut pembatalan alokasi bahan mentah
    5. Mengganti status bahan dalam proses
        1. Bahan dalam proses secara default akan berstatus ON PROCESS karena sedang digunakan untuk membuah produk, setelah produk jadi maka status bahan dalam proses adalah DONE/selesai
        2. Memilih menu daftar bahan dalam proses
        3. Menekan tombol DONE pada salah satu bahan dalam proses
        4. Akan muncul popup konfirmasi
        5. Jika yakin maka menekan tombol konfirmasi
        6. Status bahan dalam proses akan berganti menjadi DONE
    6. Mencari bahan dalam proses
        1. Memilih menu lihat bahan dalam proses
        2. Data bahan dalam proses akan muncul

### Barang Jadi
    1. Menambah barang jadi
        1. Memilih menu tambah barang jadi
        2. Menambahkan data barang jadi seperti (nama_barang, stok, harga_jual, harga_modal, aktif, gambar), nama barang harus unik
        3. menekan tombol tambah barang jadi
        4. Jika berhasil maka data barang jadi akan ditambahkan ke database
    2. Melihat daftar barang jadi
        1. Memilih menu lihat barang jadi
        2. Data barang jadi akan dimunculkan
    3. Mengubah barang jadi
        1. Memilih menu lihat barang jadi
        2. Menekan tombol ubah pada barang jadi yang ingin diubah
        3. Mengubah data barang jadi
        4. Menekan tombol ubah
        5. Akan muncul popup konfirmasi
        6. Jika yakin maka tekan tombol konfirmasi ubah
        7. Data barang jadi berhasil diubah
    4. Menghapus barang jadi
        1. Memilih menu lihat barang jadi
        2. Menekan tombol hapus pada barang jadi yang ingin dihapus
        3. Akan muncul popup konfirmasi penghapusan data barang jadi
        4. Jika yakin, maka tekan tombol konfirmasi hapus
        5. Data barang jadi tersebut terhapus dari database
    5. Mencari barang jadi
        1. Memilih menu lihat barang jadi
        2. Mengisi nama barang jadi pada form pencarian
        3. Jika ditemukan maka barang jadi akan ditampilkan

### Pemasukan
    1. Menambah pemasukan
        1. Memilih menu tambah pemasukan
        2. Mengisi data pemasukan seperti (nama, id_barang_jadi, jumlah, total, atas_nama, no_hp, deskripsi)
        3. Menekan tombol tambah pemasukan
    2. Melihat daftar pemasukan
        1. Memilih menu lihat pemasukan
        2. Data pemasukan akan ditampilkan
    3. Mengubah pemasukan
        1. Memilih menu lihat pemasukan
        2. Menekan tombol ubah pada data pemasukan yang ingin diubah datanya
        3. Form ubah akan muncul
        4. Mengubah data pemasukan
        5. Menekan tombol ubah pemasukan
        6. Akan muncul popup konfirmasi
        7. Menekan tombol konfirmasi jika yakin
    4. Menghapus pemasukan
        1. Memilih menu menu lihat pemasukan
        2. Menekan tombol hapus pada data pemasukan yang ingin dihapus
        3. Akan muncul popup konfirmasi apakah yakin ingin menghapus pemasukan tsb
        4. Jika yakin maka tekan tombol konfirmasi hapus
    5. Mencari pemasukan
        1. Memilih menu lihat pemasukan
        2. Mengisi nama pemasukan pada form pencarian
        3. Jika ditemukan maka datanya akan ditampilkan

### Pengeluaran
    1. Menambah pengeluaran
        1. Memilih menu tambah pengeluaran
        2. Mengisi data pengeluaran seperti (nama, deskripsi, cost, gambar bon/nota)
        3. Menekan tombol tambah pengeluaran
    2. Melihat daftar pengeluaran
        1. Memilih menu lihat pengeluaran
        2. Data pengeluaran akan ditampilkan
    3. Mengubah pengeluaran
        1. Memilih menu lihat pengeluaran
        2. Menekan tombol ubah pada data pengeluaran yang ingin diubah datanya
        3. Form ubah akan muncul
        4. Mengubah data pengeluaran
        5. Menekan tombol ubah pengeluaran
        6. Akan muncul popup konfirmasi
        7. Menekan tombol konfirmasi jika yakin
    4. Menghapus pengeluaran
        1. Memilih menu menu lihat pengeluaran
        2. Menekan tombol hapus pada data pengeluaran yang ingin dihapus
        3. Akan muncul popup konfirmasi apakah yakin ingin menghapus pengeluaran tsb
        4. Jika yakin maka tekan tombol konfirmasi hapus
    5. Mencari pengeluaran
        1. Memilih menu lihat pengeluaran
        2. Mengisi nama pengeluaran pada form pencarian
        3. Jika ditemukan maka datanya akan ditampilkan

### Hutang
    1. Menambah hutang
        1. Memilih menu tambah hutang
        2. Mengisi data hutang seperti (nama, jumlah(harga), deskripsi, atas_nama(penghutang/terhutang), no_telp, jenis(memberi/menerima), status(selesai/belum))
        3. Menekan tombol tambah hutang
    2. Melihat daftar hutang
        1. Memilih menu lihat hutang
        2. Data hutang akan ditampilkan
    3. Mengubah pengeluaran
        1. Memilih menu lihat hutang
        2. Menekan tombol ubah pada data hutang yang ingin diubah datanya
        3. Form ubah akan muncul
        4. Mengubah data hutang
        5. Menekan tombol ubah hutang
        6. Akan muncul popup konfirmasi
        7. Menekan tombol konfirmasi jika yakin
    4. Menghapus hutang
        1. Memilih menu menu lihat hutang
        2. Menekan tombol hapus pada data hutang yang ingin dihapus
        3. Akan muncul popup konfirmasi apakah yakin ingin menghapus hutangtsb
        4. Jika yakin maka tekan tombol konfirmasi hapus
    5. Mencari hutang
        1. Memilih menu lihat hutang
        2. Mengisi nama hutang pada form pencarian
        3. Jika ditemukan maka datanya akan ditampilkan

## Instalasi (Windows 10)
=== BAHAN-BAHAN ===
- aplikasi XAMPP versi terbaru (link: https://www.apachefriends.org/index.html lalu klik tombol XAMPP for Windows)
- file projek moneytory dalam bentuk file .zip, contoh: moneytory.zip
- aplikasi Composer versi terbaru (link: https://getcomposer.org/Composer-Setup.exe)


=== PERSIAPAN ===
- buat folder baru di drive C:\ dengan nama folder yang diinginkan, misalkan moneytory
- download aplikasi XAMPP lalu simpan ke folder moneytory
- download aplikasi Composer lalu simpan ke folder moneytory
- Simpan file proyek ke folder moneytory


=== INSTALASI ===
1. Mengekstrak file proyek
    - ekstrak file proyek yang berbentuk .zip pada folder yang diinginkan, misalkan di C:\moneytory\
2. Menginstall XAMPP, [video tutorial](https://www.youtube.com/watch?v=Y7Eg3oM6mCk)
    - install aplikasi XAMPP ke direktori C:\xampp\
    - buka aplikasi xampp dan jalankan service Apache dan MySQL dengan menekan tombol [Start] pada masing-masing service
3. Menginstall Composer, [video tutorial](https://www.youtube.com/watch?v=LHgDEUkbuew)
2. Membuat database, [video tutorial](https://www.youtube.com/watch?v=j1WVRtcauqw)
    - Klik tombol [Admin] pada bagian service MySQL, maka akan terbuka tab pada web browser yang akan mengarahkan pada halaman phpmyadmin
    - tekan menu [New] yang ada pada bagian kiri atas
    - isi kolom [Database name] dengan nama moneytory lalu tekan Create
4. Menambahkan data awal ke database
    - masuk ke folder C:\moneytory\backup\database
    - terdapat file bernama moneytory.sql lalu drag and drop ke halaman phpmyadmin, jika ada , jika berhasil maka database akan ditambahkan beberapa tabel
5. Menginstall package yang diperlukan
    - pindah ke direktori C:\moneytory\
    - tekan tombol Shift + Klik Kanan lalu pilih menu Open PowerShell menu here
    - ketikkan perintah "composer install" tanpa kutip dua, maka aplikasi composer akan menginstall beberapa package (semacam plugin) pada proyek, tunggu saja beberapa saat
    - ketikkan "php artisan key:generate"
    - ketikkan "php artisan storage:link"
6. Menjalankan aplikasi
    - masih pada direktori yang sama di PowerShell, ketikkan perintah "php artisan serve" tanpa kutip dua, untuk menjalankan proyek
    - buka web browser favoritmu dan ketikkan 127.0.0.1:8000 pada kolom pencarian
    - jika berhasil maka aplikasi berhasil diinstall