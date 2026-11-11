<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Praktikum 7 PHP</title>
</head>
<body>

    <?php
        echo "Belajar PHP";
    ?>

</body>
</html>

<?php
/*
 * PRAKTIKUM 7 - PEMROGRAMAN SERVER-SIDE DENGAN PHP
 * Gabungan Latihan 1-7, Mini Project, dan Eksperimen Mandiri
 * Simpan sebagai index.php di folder htdocs/Lab7Web_PHP
 */

function e($nilai) {
    return htmlspecialchars((string)$nilai, ENT_QUOTES, 'UTF-8');
}

function hitungDiskon($harga, $persen) {
    return $harga - ($harga * ($persen / 100));
}

function hitungLuasPersegiPanjang($panjang, $lebar) {
    return $panjang * $lebar;
}

function cekKelulusan($nilai) {
    return $nilai >= 60 ? "Lulus" : "Tidak lulus";
}

function formatRupiah($angka) {
    return "Rp" . number_format($angka, 0, ',', '.');
}

function validasiNimEksperimen($nim) {
    return ctype_digit($nim) && strlen($nim) === 10;
}

$halaman = $_GET['halaman'] ?? 'beranda';
$judulHalaman = [
    'beranda' => 'Beranda',
    'latihan1' => 'Latihan 1 - Menjalankan PHP',
    'latihan2' => 'Latihan 2 - Variabel dan Percabangan',
    'latihan3' => 'Latihan 3 - Array dan Perulangan',
    'latihan4' => 'Latihan 4 - Function',
    'latihan5' => 'Latihan 5 - Form GET',
    'latihan6' => 'Latihan 6 - Form POST',
    'latihan7' => 'Latihan 7 - Pengolahan Data',
    'mini_project' => 'Mini Project - Data Mahasiswa',
    'eksperimen' => 'Eksperimen Mandiri',
    'evaluasi' => 'Pertanyaan Evaluasi'
];
if (!isset($judulHalaman[$halaman])) {
    $halaman = 'beranda';
}

$pesan = '';
$error = [];
$hasil = null;

// Pemrosesan form Latihan 6
if ($halaman === 'latihan6' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $prodi = trim($_POST['prodi'] ?? '');
    if ($nama === '' || $prodi === '') {
        $pesan = 'Semua kolom wajib diisi.';
    } else {
        $pesan = 'Data berhasil diterima.';
        $hasil = ['nama' => $nama, 'prodi' => $prodi];
    }
}

// Pemrosesan form Latihan 7
if ($halaman === 'latihan7' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $barang = trim($_POST['barang'] ?? '');
    $hargaInput = $_POST['harga'] ?? '';
    $jumlahInput = $_POST['jumlah'] ?? '';
    if ($barang === '' || !is_numeric($hargaInput) ||
        !ctype_digit((string)$jumlahInput) ||
        (float)$hargaInput < 0 || (int)$jumlahInput < 1) {
        $pesan = 'Periksa kembali nama barang, harga, dan jumlah. Harga minimal 0 dan jumlah minimal 1.';
    } else {
        $hasil = [
            'barang' => $barang,
            'harga' => (float)$hargaInput,
            'jumlah' => (int)$jumlahInput,
            'subtotal' => (float)$hargaInput * (int)$jumlahInput
        ];
    }
}

// Pemrosesan Mini Project
if ($halaman === 'mini_project' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataMahasiswa = [
        'nama' => trim($_POST['nama'] ?? ''),
        'nim' => trim($_POST['nim'] ?? ''),
        'prodi' => trim($_POST['prodi'] ?? ''),
        'semester' => $_POST['semester'] ?? '',
        'email' => trim($_POST['email'] ?? '')
    ];

    if ($dataMahasiswa['nama'] === '') $error[] = 'Nama wajib diisi.';
    if ($dataMahasiswa['nim'] === '') {
        $error[] = 'NIM wajib diisi.';
    } elseif (!ctype_digit($dataMahasiswa['nim'])) {
        $error[] = 'NIM hanya boleh berisi angka.';
    } elseif (strlen($dataMahasiswa['nim']) < 8 || strlen($dataMahasiswa['nim']) > 15) {
        $error[] = 'NIM harus terdiri dari 8 sampai 15 angka.';
    }
    if ($dataMahasiswa['prodi'] === '') $error[] = 'Program studi wajib diisi.';
    if (!ctype_digit((string)$dataMahasiswa['semester']) ||
        (int)$dataMahasiswa['semester'] < 1 || (int)$dataMahasiswa['semester'] > 14) {
        $error[] = 'Semester harus berupa angka 1–14.';
    }
    if (!filter_var($dataMahasiswa['email'], FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Format email tidak valid.';
    }

    if (!$error) {
        $hasil = $dataMahasiswa;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Praktikum 7 - PHP</title>
<style>
* { box-sizing: border-box; }
body { margin: 0; font-family: Arial, sans-serif; background: #f4f6f9; color: #222; }
header { background: #173b67; color: white; padding: 24px max(20px, calc((100% - 1050px)/2)); }
header h1 { margin: 0 0 7px; font-size: 25px; }
header p { margin: 0; }
.layout { max-width: 1050px; margin: 22px auto; padding: 0 16px; display: grid; grid-template-columns: 230px 1fr; gap: 20px; }
nav, main { background: white; border-radius: 10px; padding: 18px; box-shadow: 0 2px 10px #0000000d; }
nav h3 { margin-top: 0; }
nav a { display: block; padding: 9px 10px; color: #174a7e; text-decoration: none; border-radius: 6px; margin: 3px 0; }
nav a:hover, nav a.aktif { background: #e8f1fb; font-weight: bold; }
main h2 { margin-top: 0; color: #173b67; }
label { display: block; margin: 12px 0 5px; }
input { width: 100%; max-width: 520px; padding: 9px; border: 1px solid #bbb; border-radius: 5px; }
button { padding: 9px 15px; border: 0; border-radius: 5px; background: #174a7e; color: white; cursor: pointer; margin: 14px 7px 0 0; }
button[type=reset] { background: #666; }
.notice { padding: 12px; background: #eef6ff; border-left: 4px solid #3979b9; margin: 14px 0; }
.error { padding: 12px; background: #fff0f0; border-left: 4px solid #c33; margin: 14px 0; }
.result { padding: 12px; background: #eff9f0; border-left: 4px solid #39834a; margin: 14px 0; }
code { background: #f0f0f0; padding: 2px 5px; border-radius: 4px; }
table { border-collapse: collapse; width: 100%; margin: 12px 0; }
th, td { border: 1px solid #ddd; text-align: left; padding: 9px; vertical-align: top; }
th { background: #f1f4f8; }
footer { text-align: center; color: #666; padding: 20px; font-size: 13px; }
@media(max-width:700px) { .layout { grid-template-columns: 1fr; } nav { display: grid; grid-template-columns: 1fr 1fr; gap: 2px; } nav h3 { grid-column: 1/-1; } }
</style>
</head>
<body>
<header>
    <h1>Praktikum 7: Pemrograman Server-Side dengan PHP</h1>
    <p>Latihan 1–7, Mini Project, Eksperimen Mandiri, dan Evaluasi</p>
</header>

<div class="layout">
<nav>
    <h3>Menu Praktikum</h3>
    <?php foreach ($judulHalaman as $key => $judul): ?>
        <a class="<?= $halaman === $key ? 'aktif' : '' ?>" href="?halaman=<?= e($key) ?>"><?= e($judul) ?></a>
    <?php endforeach; ?>
</nav>

<main>
<?php if ($halaman === 'beranda'): ?>
    <h2>Selamat Datang</h2>
    <p>Website ini menggabungkan seluruh materi Praktikum 7 dalam satu file PHP dan satu halaman dengan menu navigasi.</p>
    <div class="notice">
        <strong>Cara menggunakan:</strong> Pilih materi pada menu di sebelah kiri. Setiap latihan dapat dibuka tanpa berpindah file.
    </div>
    <h3>Daftar materi</h3>
    <ol>
        <li>Menjalankan PHP</li><li>Variabel, operator, dan percabangan</li>
        <li>Perulangan dan array</li><li>Function</li><li>Form GET</li>
        <li>Form POST</li><li>Pengolahan data sederhana</li>
        <li>Mini Project formulir data mahasiswa</li><li>Eksperimen mandiri</li>
        <li>Pertanyaan evaluasi</li>
    </ol>

<?php elseif ($halaman === 'latihan1'): ?>
    <h2>Latihan 1 — Menjalankan PHP</h2>
    <p>PHP berhasil dijalankan.</p>
    <p>Waktu server: <strong><?= date('d-m-Y H:i:s') ?></strong></p>
    <p>Kode PHP diproses oleh server dan hasilnya ditampilkan di browser.</p>

<?php elseif ($halaman === 'latihan2'): ?>
    <h2>Latihan 2 — Variabel, Operator, dan Percabangan</h2>
    <?php
    $namaMhs = 'Siti'; $tugas = 85; $uts = 78; $uas = 90;
    $nilaiAkhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
    if ($nilaiAkhir >= 85) $predikat = 'A';
    elseif ($nilaiAkhir >= 75) $predikat = 'B';
    elseif ($nilaiAkhir >= 60) $predikat = 'C';
    else $predikat = 'D';
    ?>
    <table>
        <tr><th>Komponen</th><th>Nilai</th><th>Bobot</th></tr>
        <tr><td>Tugas</td><td><?= $tugas ?></td><td>30%</td></tr>
        <tr><td>UTS</td><td><?= $uts ?></td><td>30%</td></tr>
        <tr><td>UAS</td><td><?= $uas ?></td><td>40%</td></tr>
    </table>
    <p>Nama: <?= e($namaMhs) ?></p>
    <p>Nilai akhir: <?= number_format($nilaiAkhir, 2, ',', '.') ?></p>
    <p>Predikat: <strong><?= $predikat ?></strong></p>

<?php elseif ($halaman === 'latihan3'): ?>
    <h2>Latihan 3 — Perulangan dan Array</h2>
    <?php $mahasiswa = ['Alya', 'Bima', 'Citra', 'Doni', 'Eka', 'Fajar', 'Gita']; ?>
    <p>Daftar mahasiswa ditampilkan menggunakan <code>foreach</code>.</p>
    <ol><?php foreach ($mahasiswa as $namaItem): ?><li><?= e($namaItem) ?></li><?php endforeach; ?></ol>

<?php elseif ($halaman === 'latihan4'): ?>
    <h2>Latihan 4 — Function</h2>
    <p>Harga awal Rp150.000 dengan diskon 10%: <strong><?= formatRupiah(hitungDiskon(150000, 10)) ?></strong></p>
    <p>Luas persegi panjang dengan panjang 8 dan lebar 4: <strong><?= hitungLuasPersegiPanjang(8, 4) ?></strong></p>
    <p>Status kelulusan nilai 78: <strong><?= cekKelulusan(78) ?></strong></p>

<?php elseif ($halaman === 'latihan5'): ?>
    <h2>Latihan 5 — Memproses Form GET</h2>
    <form method="GET">
        <input type="hidden" name="halaman" value="latihan5">
        <label for="kata">Kata kunci nama:</label>
        <input id="kata" name="kata" type="text" value="<?= e($_GET['kata'] ?? '') ?>">
        <button type="submit">Cari</button>
    </form>
    <?php
    $daftarNama = ['Alya', 'Bima', 'Citra', 'Doni', 'Eka', 'Fajar', 'Gita'];
    if (isset($_GET['kata'])):
        $kata = trim($_GET['kata']);
        $cocok = array_filter($daftarNama, fn($n) => $kata !== '' && stripos($n, $kata) !== false);
    ?>
        <?php if ($kata === ''): ?><p>Masukkan kata kunci terlebih dahulu.</p>
        <?php elseif ($cocok): ?><p>Hasil pencarian:</p><ul><?php foreach ($cocok as $n): ?><li><?= e($n) ?></li><?php endforeach; ?></ul>
        <?php else: ?><p>Nama tidak ditemukan.</p><?php endif; ?>
    <?php endif; ?>
    <p class="notice">Perhatikan URL setelah form dikirim. GET mengirim data melalui parameter URL, sehingga jangan gunakan untuk kata sandi atau data sensitif.</p>

<?php elseif ($halaman === 'latihan6'): ?>
    <h2>Latihan 6 — Memproses Form POST</h2>
    <form method="POST">
        <label>Nama:</label><input type="text" name="nama" required value="<?= e($_POST['nama'] ?? '') ?>">
        <label>Program Studi:</label><input type="text" name="prodi" required value="<?= e($_POST['prodi'] ?? '') ?>">
        <button type="submit">Kirim Data</button><button type="reset">Reset</button>
    </form>
    <?php if ($pesan !== ''): ?>
        <div class="<?= $hasil ? 'result' : 'error' ?>"><strong><?= e($pesan) ?></strong>
        <?php if ($hasil): ?><p>Nama: <?= e($hasil['nama']) ?></p><p>Program Studi: <?= e($hasil['prodi']) ?></p><?php endif; ?></div>
    <?php endif; ?>

<?php elseif ($halaman === 'latihan7'): ?>
    <h2>Latihan 7 — Pengolahan Data Sederhana</h2>
    <p>Masukkan nama barang, harga, dan jumlah untuk menghitung subtotal.</p>
    <form method="POST">
        <label>Nama barang:</label><input name="barang" required value="<?= e($_POST['barang'] ?? '') ?>">
        <label>Harga:</label><input name="harga" type="number" min="0" step="0.01" required value="<?= e($_POST['harga'] ?? '') ?>">
        <label>Jumlah:</label><input name="jumlah" type="number" min="1" step="1" required value="<?= e($_POST['jumlah'] ?? '') ?>">
        <button type="submit">Hitung</button><button type="reset">Reset</button>
    </form>
    <?php if ($pesan !== ''): ?><div class="error"><?= e($pesan) ?></div><?php endif; ?>
    <?php if ($hasil): ?><div class="result"><h3>Ringkasan Transaksi</h3>
        <p>Barang: <?= e($hasil['barang']) ?></p><p>Harga: <?= formatRupiah($hasil['harga']) ?></p>
        <p>Jumlah: <?= $hasil['jumlah'] ?></p><p>Subtotal: <strong><?= formatRupiah($hasil['subtotal']) ?></strong></p>
    </div><?php endif; ?>

<?php elseif ($halaman === 'mini_project'): ?>
    <h2>Mini Project — Formulir Data Mahasiswa</h2>
    <p>Isi seluruh kolom. Semester harus 1–14, email harus valid, dan NIM pada implementasi ini harus 8–15 digit.</p>
    <form method="POST">
        <label>Nama:</label><input name="nama" required value="<?= e($_POST['nama'] ?? '') ?>">
        <label>NIM:</label><input name="nim" required inputmode="numeric" value="<?= e($_POST['nim'] ?? '') ?>">
        <label>Program Studi:</label><input name="prodi" required value="<?= e($_POST['prodi'] ?? '') ?>">
        <label>Semester:</label><input name="semester" type="number" min="1" max="14" step="1" required value="<?= e($_POST['semester'] ?? '') ?>">
        <label>Email:</label><input name="email" type="email" required value="<?= e($_POST['email'] ?? '') ?>">
        <button type="submit">Kirim Data</button><button type="reset">Reset</button>
    </form>
    <?php if ($error): ?><div class="error"><strong>Data belum valid:</strong><ul><?php foreach ($error as $err): ?><li><?= e($err) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
    <?php if ($hasil): ?><div class="result"><h3>Data Mahasiswa Berhasil Diterima</h3>
        <p>Nama: <?= e($hasil['nama']) ?></p><p>NIM: <?= e($hasil['nim']) ?></p>
        <p>Program Studi: <?= e($hasil['prodi']) ?></p><p>Semester: <?= e($hasil['semester']) ?></p><p>Email: <?= e($hasil['email']) ?></p>
    </div><?php endif; ?>

<?php elseif ($halaman === 'eksperimen'): ?>
    <h2>Eksperimen Mandiri</h2>
    <h3>1. Menghitung rata-rata tiga nilai</h3>
    <?php $rata = (80 + 85 + 90) / 3; ?>
    <p>Nilai 80, 85, dan 90 menghasilkan rata-rata <?= number_format($rata, 2, ',', '.') ?>.</p>

    <h3>2. Mencari nama dari array dengan GET</h3>
    <form method="GET"><input type="hidden" name="halaman" value="eksperimen">
        <label>Nama yang dicari:</label><input name="cari" value="<?= e($_GET['cari'] ?? '') ?>">
        <button type="submit">Cari</button>
    </form>
    <?php
    $namaArray = ['Alya', 'Bima', 'Citra', 'Doni', 'Eka'];
    if (isset($_GET['cari'])) {
        $keyword = trim($_GET['cari']);
        $cariHasil = array_filter($namaArray, fn($n) => $keyword !== '' && stripos($n, $keyword) !== false);
        if ($keyword === '') echo '<p>Masukkan kata kunci.</p>';
        elseif ($cariHasil) echo '<p>Ditemukan: ' . e(implode(', ', $cariHasil)) . '</p>';
        else echo '<p>Nama tidak ditemukan.</p>';
    }
    ?>
    <h3>3. Function format Rupiah</h3><p>250000 menjadi <?= formatRupiah(250000) ?>.</p>
    <h3>4. Validasi NIM</h3>
    <?php $nimContoh = '1234567890'; ?>
    <p>NIM <?= e($nimContoh) ?>: <?= validasiNimEksperimen($nimContoh) ? 'Valid' : 'Tidak valid' ?>. Ketentuan eksperimen: tepat 10 digit angka.</p>
    <h3>5. Tombol reset</h3>
    <form><label>Contoh input:</label><input name="contoh" placeholder="Ketik sesuatu">
        <button type="reset">Reset</button></form>
    <p>Tombol reset mengembalikan isian form ke nilai awal di browser. Reset tidak menghapus data yang sudah diproses atau disimpan di server.</p>

<?php elseif ($halaman === 'evaluasi'): ?>
    <h2>Pertanyaan Evaluasi dan Jawaban</h2>
    <h3>1. Apa perbedaan pemrosesan client-side dan server-side?</h3>
    <p>Client-side adalah proses yang dijalankan di browser pengguna, misalnya HTML, CSS, dan JavaScript. Server-side adalah proses yang dijalankan di server, misalnya menerima permintaan, memproses input, menjalankan aturan aplikasi, dan mengirimkan respons ke browser.</p>
    <h3>2. Mengapa file PHP harus dijalankan melalui web server?</h3>
    <p>Karena PHP merupakan bahasa server-side. Web server yang mendukung PHP menjalankan kode PHP dan mengirimkan hasilnya ke browser.</p>
    <h3>3. Apa fungsi tanda $ pada variabel PHP?</h3>
    <p>Tanda $ merupakan awalan untuk menandai variabel PHP, misalnya <code>$nama = "Andi";</code>.</p>
    <h3>4. Apa perbedaan metode GET dan POST?</h3>
    <p>GET mengirim data melalui parameter URL dan sesuai untuk permintaan yang tidak mengubah data. POST mengirim data pada body permintaan dan lazim digunakan untuk pengiriman form. POST bukan enkripsi; HTTPS tetap diperlukan untuk melindungi data saat dikirim.</p>
    <h3>5. Mengapa input pengguna perlu divalidasi di sisi server?</h3>
    <p>Karena validasi browser dapat dilewati. Server harus memeriksa data agar sesuai dengan aturan aplikasi sebelum diproses.</p>
    <h3>6. Apa fungsi htmlspecialchars() ketika menampilkan data dari form?</h3>
    <p>Fungsi ini mengubah karakter khusus HTML menjadi bentuk yang aman ditampilkan dan mengurangi risiko injeksi HTML atau script.</p>
    <h3>7. Apa manfaat penggunaan function dalam program PHP?</h3>
    <p>Function membuat kode lebih terstruktur, dapat digunakan kembali, dan menghindari penulisan kode yang sama berulang kali.</p>
<?php endif; ?>
</main>
</div>
<footer>Modul Praktikum Pemrograman Web — Praktikum 7</footer>
</body>
</html>
