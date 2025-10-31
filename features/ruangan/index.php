<?php
$data = mysqli_query($conn, "SELECT * FROM ruangan");
$ruangan =  mysqli_fetch_all($data, MYSQLI_ASSOC);

?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Data Kategori</h3>
                </div>
                <div class="col-md-6">
                    <div class="text-end">
                        <a href="./index.php?page=ruangan&view=add" class="btn btn-primary btn-sm"> <i class="fa-solid fa-plus"></i> Tambah</a>
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

                                <th>Nama</th>

                                <th>Lantai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ruangan as $no => $k): ?>
                                <tr>
                                    <td><?= $no+1 ?></td>
                                    <td><?= $k['nama'] ?></td>
                                    <td><?= $k['lantai'] ?></td>

                                    <td><button class="btn btn-warning btn-sm"> <i class="fas fa-pen"></i> edit</button> <button class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> hapus</button></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>