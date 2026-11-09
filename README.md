📖 DOKUMENTASI SISTEM INFORMASI PENJUALAN TOKO (db_tokoku)
Selamat datang di repositori proyek Sistem Informasi Penjualan Toko. Proyek ini merupakan hasil integrasi dari praktikum Basis Data Lanjutan (Jobsheet 1 s.d. 5) yang mencakup pembuatan struktur database, implementasi View, Advanced Query (JOIN & Subquery), Stored Procedure, Stored Function, Trigger, hingga implementasi antarmuka (Frontend) berbasis web menggunakan PHP dan Bootstrap.

Dokumen ini dibuat sebagai panduan komprehensif untuk memahami seluruh fitur, arsitektur, dan alur kerja sistem.

🏗️ 1. ARSITEKTUR SISTEM
Aplikasi ini menggunakan arsitektur Client-Server sederhana:

Backend (Database Server): MySQL / MariaDB (via XAMPP).

Frontend (Client): HTML5, CSS3 (Bootstrap 5), dan PHP Native.

Web Server: Apache (via XAMPP).

Data mengalir dari Database MySQL, diproses oleh skrip PHP, lalu ditampilkan ke layar pengguna (browser) dalam bentuk tabel yang rapi dan interaktif.

🗄️ 2. STRUKTUR DATABASE & RELASI (db_tokoku)
Sistem ini menggunakan database utama bernama db_tokoku. Terdapat dua tabel utama yang saling berelasi, serta tabel pendukung untuk audit log.

A. Tabel tbl_pelanggan (Master Data)
Berfungsi menyimpan data identitas pelanggan toko.

id_pelanggan (INT, Primary Key, Auto Increment): ID unik pelanggan.

nama_pelanggan (VARCHAR 100): Nama lengkap pelanggan.

kota (VARCHAR 50): Domisili pelanggan.

B. Tabel tbl_transaksi (Data Transaksional)
Berfungsi menyimpan riwayat belanja pelanggan. Tabel ini memiliki relasi Foreign Key ke tabel pelanggan.

id_transaksi (INT, Primary Key, Auto Increment): ID unik transaksi.

tanggal (DATE): Tanggal transaksi terjadi.

id_pelanggan (INT, Foreign Key): Merujuk ke tbl_pelanggan.id_pelanggan.

total_belanja (DECIMAL 12,2): Nominal uang yang dibelanjakan.

C. Tabel Log (log_pelanggan & log_perubahan_pelanggan)
Tabel audit trail yang diciptakan secara otomatis oleh Trigger untuk mencatat riwayat penambahan dan perubahan data pelanggan.

🚀 3. FITUR UNGGULAN (Penjelasan Mendalam)
Sistem ini tidak hanya menggunakan query dasar, tetapi juga mengimplementasikan fitur-fitur tingkat lanjut (Advanced Database Programming).

🔍 3.1. Fitur Database VIEW (Laporan Cerdas)
View adalah tabel virtual yang menyederhanakan query kompleks agar tidak perlu menulis ulang kode JOIN yang panjang.

view_laporan_transaksi: Menggabungkan tabel transaksi dan pelanggan. Fitur ini memungkinkan Frontend (laporan.php) menampilkan detail siapa yang belanja, di kota mana, dan berapa totalnya, hanya dengan satu perintah SELECT * FROM view_laporan_transaksi.

view_total_belanja_pelanggan: Menggunakan fungsi agregasi (COUNT dan SUM). Fitur ini secara otomatis menghitung total pengeluaran masing-masing pelanggan dan berapa kali mereka bertransaksi.

🧩 3.2. Fitur Advanced JOIN & Subquery (Analisis Data)
Sistem ini memiliki kemampuan analisis data tingkat lanjut:

Left Join: Digunakan untuk menampilkan seluruh pelanggan, termasuk pelanggan yang belum pernah bertransaksi (bernilai NULL).

Subquery (Nested Query): Digunakan pada laporan untuk mencari transaksi yang nilainya di atas rata-rata total belanja seluruh toko.

UNION: Menggabungkan data dari dua kolom berbeda (misal: daftar nama pelanggan dan daftar kota) ke dalam satu tampilan laporan.

⚙️ 3.3. Fitur Stored Procedure (Otomatisasi Bisnis)
Stored Procedure adalah sekumpulan perintah SQL yang disimpan di server. Fitur ini memudahkan aplikasi untuk memanggil proses bisnis yang kompleks.

TampilPelanggan(): Menampilkan seluruh data pelanggan.

TambahPelanggan(nama, kota): Memasukkan data pelanggan baru tanpa harus menulis query INSERT berulang kali.

LaporanTransaksi(id): Memanggil riwayat transaksi spesifik hanya berdasarkan ID pelanggan.

HitungPelanggan(OUT jumlah): Menggunakan parameter Output untuk mengembalikan jumlah total pelanggan yang terdaftar.

🧮 3.4. Fitur Stored Function (Kalkulasi Otomatis)
Berbeda dengan Procedure, Function mengembalikan nilai dan bisa dipanggil langsung di dalam query SELECT.

HitungDiskon(harga, diskon): Menghitung harga akhir setelah dipotong diskon secara presisi.

HitungTotal(harga, jumlah): Kalkulasi otomatis harga dikali jumlah barang.

HitungPajak(harga): Menghitung nilai pajak (PPN) sebesar 11%.

KategoriBelanja(total): Menggunakan logika CASE untuk memberikan status otomatis (Gold, Silver, Reguler) berdasarkan nominal total belanja.

KonversiNilai(nilai): Mengubah nilai angka (0-100) menjadi nilai huruf (A-E).

🛡️ 3.5. Fitur Database Trigger (Keamanan & Audit Trail)
Trigger adalah kode yang berjalan otomatis saat ada operasi Insert/Update/Delete pada tabel. Ini adalah fitur keamanan krusial.

after_insert_pelanggan: Setiap ada pelanggan baru yang masuk lewat Frontend, sistem otomatis mencatat log aktivitas tanpa perlu kode tambahan di PHP.

after_update_pelanggan: Fitur pelacak perubahan. Jika admin mengubah nama pelanggan, trigger ini merekam nama lama (OLD) dan nama baru (NEW) ke dalam tabel log.

before_insert_transaksi (Validasi): Fitur pencegah error. Jika kasir (Frontend) tidak sengaja menginput transaksi dengan nominal negatif (minus), Trigger akan menolak data tersebut dan memunculkan pesan error sebelum data masuk ke database.

💻 4. ANTARMUKA FRONTEND (PHP & BOOTSTRAP)
Untuk mempermudah penggunaan database, dibuatlah antarmuka web (toko_app) menggunakan PHP dan Bootstrap 5.

Halaman index.php (Data Pelanggan)

Fitur: Menampilkan daftar seluruh pelanggan dari database.

Desain: Menggunakan tabel striped dan hover agar memudahkan admin membaca data pelanggan satu per satu.

Halaman laporan.php (Laporan Penjualan)

Fitur: Memanggil data dari View view_laporan_transaksi.

Desain: Tabel laporan dilengkapi dengan format mata uang Rupiah otomatis (contoh: Rp 250.000) menggunakan fungsi PHP number_format(), sehingga laporan terlihat profesional dan mudah dibaca oleh pemilik toko.

🛠️ 5. CARA INSTALASI DAN MENJALANKAN SISTEM
Bagi penguji atau pengguna yang ingin menjalankan proyek ini, ikuti langkah berikut:

Persiapan Server:

Instal XAMPP (pastikan versi PHP 7.4 atau lebih baru).

Jalankan modul Apache dan MySQL dari XAMPP Control Panel.

Import Database:

Buka browser, akses http://localhost/phpmyadmin/.

Buat database baru dengan nama db_tokoku.

Masuk ke tab SQL, lalu copy-paste seluruh kode SQL dari file jobsheet_1_sampai_5.sql (yang telah kita buat sebelumnya) dan klik Go.

Menjalankan Frontend:

Letakkan folder toko_app (berisi koneksi.php, index.php, dan laporan.php) ke dalam direktori C:\xampp\htdocs\.

Buka browser dan akses http://localhost/toko_app/.

Sistem siap digunakan.

🎯 6. KESIMPULAN PROYEK
Proyek ini mendemonstrasikan pemahaman holistik tentang pemrograman basis data. Mulai dari perancangan struktur tabel (DDL), manipulasi data (DML), optimalisasi query menggunakan View dan Subquery, pemisahan logika bisnis menggunakan Stored Procedure/Function, hingga pengamanan data menggunakan Trigger. Semua komponen ini berhasil diintegrasikan ke dalam antarmuka web (Frontend) yang fungsional menggunakan PHP, menjadikannya sebuah ekosistem Sistem Informasi Penjualan yang utuh.

Dibuat untuk memenuhi Tugas Praktikum Pemrograman Basis Data Lanjutan.
Dosen Pengampu: Hendrik Dwi Yusyanto

