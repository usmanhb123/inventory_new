<?php
$data = mysqli_query($conn, "SELECT barang.*, 
        kategori.nama AS nama_kategori,
        ruangan.nama AS nama_ruangan,
        ruangan.lantai AS lt
        FROM barang 
        JOIN kategori ON barang.kategori_id = kategori.id
        JOIN ruangan ON barang.ruangan_id = ruangan.id");

$barangs = $data ? mysqli_fetch_all($data, MYSQLI_ASSOC) : [];

?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Data Barang</h3>
                </div>
                <div class="col-md-6">
                    <div class="text-end">
                        <a href="app?page=barang&view=add" class="btn btn-primary btn-sm"> <i class="fa-solid fa-plus"></i> Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Kategori</th>
                                <th>Barang</th>
                                <th>Ruangan</th>

                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($barangs)): ?>
                                <?php foreach ($barangs as $b): ?>
                                    <tr>
                                        <td><?= $b['id'] ?></td>
                                        <td><?= htmlspecialchars($b['kode']) ?></td>
                                        <td><?= $b['nama_kategori'] ?></td>
                                        <td><?= htmlspecialchars($b['nama']) ?></td>
                                        <td>LT <?= $b['lt'] ?> - <?= $b['nama_ruangan'] ?></td>

                                        <td><a href="./index.php?page=barang&view=edit&id=<?= $b['id'] ?>" class="btn btn-warning btn-sm"> <i class="fas fa-pen"></i> edit</a> <button class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> hapus</button></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>