<?php

if (isset($_POST['cari'])) {

    $keyword = $_POST['keyword'];
    $data = mysqli_query($conn, "SELECT * FROM `kategori` WHERE nama LIKE '%$keyword%'");
    $kategories =  mysqli_fetch_all($data, MYSQLI_ASSOC);
} else {
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM `kategori` WHERE `id` =  $id ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "
            <script>
                alert('Data berhasil dihapus.');
             
            </script>
        ";
        } else {
            echo "
            <script>
                alert('Data gagal dihapus.');
            </script>
        ";
        }
    }
    $data = mysqli_query($conn, "SELECT * FROM kategori");
    $kategories =  mysqli_fetch_all($data, MYSQLI_ASSOC);
}




?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Data Kategori</h3>
            <div class="row">
                <div class="col-md-6">
                    <form class="d-flex" action="" method="post">
                        <input class="form-control me-2" type="search" value="<?= $_POST['keyword'] ?>" name="keyword" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="text-end">
                        <a href="./index.php?page=kategori&view=add" class="btn btn-primary btn-sm"> <i class="fa-solid fa-plus"></i> Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <?php if ($kategories) : ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Kategori</th>

                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kategories as $no => $k): ?>
                                    <tr>
                                        <td><?= $no + 1 ?></td>
                                        <td><?= $k['nama'] ?></td>
                                        <td><?= $k['keterangan'] ?></td>

                                        <td>
                                            <a href="./index.php?page=kategori&view=edit&id=<?= $k['id'] ?>" class="btn btn-warning btn-sm"> <i class="fa-solid fa-pen"></i> edit</a>
                                            <form action="" method="post" style="display: inline;" onsubmit="return confirm('anda akan menghapus data kategori?')">
                                                <input type="hidden" name="id" value="<?= $k['id'] ?>">
                                                <button class="btn btn-danger btn-sm" type="submit" name="delete"> <i class="fas fa-trash"></i> hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center">
                        <img src="./assets/img/404.png" alt="" width="400" srcset="">
                        <h1>404 not found</h1>
                        <h3>halaman tidak ditemukan</h3>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>