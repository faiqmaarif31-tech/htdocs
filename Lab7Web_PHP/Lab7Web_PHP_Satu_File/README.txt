# Praktikum 7 – Pemrograman Server-Side dengan PHP

## Deskripsi Proyek
Proyek ini merupakan hasil Praktikum 7 mata kuliah Pemrograman Web dengan topik **Pemrograman Server-Side menggunakan PHP**.

Aplikasi dibuat menggunakan bahasa pemrograman PHP dan HTML. Seluruh latihan dan mini project digabungkan ke dalam satu file utama, yaitu `index.php`, sehingga pengguna dapat mengakses setiap materi melalui menu navigasi.

## Tujuan Praktikum
1. Memahami perbedaan pemrosesan client-side dan server-side.
2. Mengenal sintaks PHP dan menjalankan file PHP melalui server lokal.
3. Menggunakan variabel, tipe data, operator, percabangan, perulangan, array, dan function.
4. Memproses data formulir menggunakan metode GET dan POST.
5. Melakukan validasi dan sanitasi input.
6. Membuat aplikasi sederhana untuk menerima, memproses, dan menampilkan data pengguna.

## Perangkat yang Digunakan
- Laptop atau PC
- PHP
- XAMPP
- Visual Studio Code
- Web Browser (Google Chrome atau browser lainnya)

## Struktur Folder

```text
Lab7Web_PHP_Satu_File/
│
├── index.php
└── README.md
```

## Fitur Aplikasi

Aplikasi ini memiliki beberapa bagian praktikum:

### 1. Latihan 1 – Menjalankan PHP
Menampilkan teks dan waktu server untuk memastikan PHP berhasil dijalankan.
Sreenshot: ![image alt] (

### 2. Latihan 2 – Variabel, Operator, dan Percabangan
Menghitung nilai akhir mahasiswa berdasarkan nilai tugas, UTS, dan UAS, kemudian menentukan predikat nilai.

### 3. Latihan 3 – Perulangan dan Array
Menampilkan daftar mahasiswa menggunakan array dan perulangan `foreach`.

### 4. Latihan 4 – Function
Menggunakan function untuk melakukan perhitungan, seperti menghitung diskon.

### 5. Latihan 5 – Form GET
Menerima kata kunci dari formulir menggunakan metode GET dan menampilkan hasilnya.

### 6. Latihan 6 – Form POST
Menerima data formulir menggunakan metode POST serta melakukan pemeriksaan input.

### 7. Latihan 7 – Pengolahan Data Sederhana
Mengolah data transaksi berdasarkan nama barang, harga, dan jumlah, kemudian menghitung subtotal.

### 8. Mini Project – Formulir Data Mahasiswa
Membuat formulir untuk memasukkan data mahasiswa berupa:
- Nama
- NIM
- Program Studi
- Semester
- Email

Data yang dimasukkan akan diperiksa melalui validasi sebelum ditampilkan.

### 9. Eksperimen Mandiri
Berisi pengembangan program seperti perhitungan nilai rata-rata, pencarian nama mahasiswa, format Rupiah, validasi NIM, dan tombol reset.

## Cara Menjalankan Program

1. Pastikan XAMPP sudah terinstal di komputer.
2. Ekstrak folder `Lab7Web_PHP_Satu_File`.
3. Pindahkan folder tersebut ke direktori `htdocs` pada XAMPP.

   Contoh lokasi:
   `C:\xampp\htdocs\Lab7Web_PHP_Satu_File`

4. Buka aplikasi XAMPP Control Panel.
5. Klik **Start** pada bagian Apache.
6. Buka browser.
7. Masukkan alamat berikut:

   `http://localhost/Lab7Web_PHP_Satu_File/`

8. Setelah halaman terbuka, pilih menu navigasi untuk mencoba setiap latihan.

**Catatan:** File PHP harus dijalankan melalui server lokal seperti XAMPP, bukan dibuka secara langsung melalui file explorer.

## Pengujian Program

Pengujian dilakukan dengan mencoba beberapa kondisi input berikut:

| No. | Pengujian | Input |
|---|---|---|
| 1 | Form GET | Memasukkan kata kunci pencarian |
| 2 | Form POST | Memasukkan nama dan program studi |
| 3 | Pengolahan transaksi | Memasukkan nama barang, harga, dan jumlah |
| 4 | Form mahasiswa | Memasukkan data mahasiswa dengan format yang benar |
| 5 | Validasi form | Mengosongkan kolom wajib atau memasukkan format email yang salah |

Hasil pengujian dapat didokumentasikan menggunakan screenshot dari browser.

## Kesimpulan
Melalui praktikum ini, mahasiswa dapat memahami dasar pemrograman server-side menggunakan PHP. Mahasiswa juga dapat menerapkan variabel, percabangan, perulangan, array, function, serta pemrosesan formulir menggunakan metode GET dan POST. Selain itu, praktikum ini memberikan pemahaman mengenai pentingnya validasi input sebelum data diproses dan ditampilkan.
