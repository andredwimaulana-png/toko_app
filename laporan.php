<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Sistem Toko db_tokoku</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Data Pelanggan</a></li>
        <li class="nav-item"><a class="nav-link active" href="laporan.php">Laporan Penjualan</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h3>Laporan Transaksi Penjualan</h3>
    <table class="table table-bordered table-hover mt-3">
        <thead class="table-success">
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Kota</th>
                <th>Total Belanja (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Memanggil VIEW yang sudah dibuat di Jobsheet 1
            $query = mysqli_query($koneksi, "SELECT * FROM view_laporan_transaksi");
            while ($data = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $data['id_transaksi'] . "</td>";
                echo "<td>" . $data['tanggal'] . "</td>";
                echo "<td>" . $data['nama_pelanggan'] . "</td>";
                echo "<td>" . $data['kota'] . "</td>";
                // Format angka ke Rupiah
                echo "<td>Rp " . number_format($data['total_belanja'], 0, ',', '.') . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>