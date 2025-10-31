<?php
// proses update data barang
if (isset($_POST['update'])) {
    $id          = $_POST['id'];
    $kategori_id = $_POST['kategori'];
    $ruangan_id  = $_POST['ruangan'];
    $kode        = $_POST['kode'];
    $nama        = $_POST['nama'];
    $keterangan  = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';

    $query = "UPDATE `barang` SET `kategori_id`='$kategori_id', `ruangan_id`='$ruangan_id', `kode`='$kode', `nama`='$nama', `keterangan`='$keterangan' WHERE `id`='$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "
            <script>
                alert('Data berhasil diupdate.');
                window.location.href = 'index.php?page=barang';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diupdate.');
            </script>
        ";
    }
}

// ambil data barang berdasarkan id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_barang = mysqli_query($conn, "SELECT * FROM barang WHERE id = '$id'");
    $barang = mysqli_fetch_assoc($query_barang);
    if (!$barang) {
        echo "<script>alert('Data tidak ditemukan.'); window.location.href = 'index.php?page=barang';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID tidak ditemukan.'); window.location.href = 'index.php?page=barang';</script>";
    exit;
}

//  ini adalah query untuk mengambil kategori
$data1 = mysqli_query($conn, "SELECT * FROM kategori");
$kategories =  mysqli_fetch_all($data1, MYSQLI_ASSOC);

// ini adalah query untuk mengambil ruangan
$data = mysqli_query($conn, "SELECT * FROM ruangan");
$ruangan =  mysqli_fetch_all($data, MYSQLI_ASSOC);

?>

<div class="d-flex justify-content-center mt-5">
    <div class="card" style="width: 70rem">
        <div class="card-header">
            <h3>
                Edit Barang
            </h3>
        </div>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $barang['id'] ?>">
            <div class="card-body">

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option value="">Pilih kategori</option>
                        <?php foreach ($kategories as $k): ?>
                            <option value="<?= $k['id'] ?>" <?= $k['id'] == $barang['kategori_id']? 'selected' : ''; ?> ><?= $k['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukan Kode" value="<?= $barang['kode'] ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Barang" value="<?= $barang['nama'] ?>" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="ruangan" class="form-label">Ruangan</label>
                    <select class="form-select" id="ruangan" name="ruangan" required aria-label="Default select example">
                        <option value="">Pilih ruangan</option>
                        <?php foreach ($ruangan as $r): ?>
                            <option value="<?= $r['id'] ?>" <?php if($r['id'] == $barang['ruangan_id']) echo 'selected'; ?> >Lt <?= $r['lantai'] ?> - <?= $r['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukan keterangan (opsional)"><?= $barang['keterangan'] ?></textarea>
                </div>

            </div>
            <div class="card-footer">
                <div class="text-end">
                    <a href="./index.php?page=barang"> <i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" name="update" class="btn btn-primary ms-2">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
