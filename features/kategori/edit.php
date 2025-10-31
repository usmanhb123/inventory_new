<?php

if ($_GET['id']) {
    $id = $_GET['id'];
    $query = "SELECT * FROM kategori WHERE id = $id ";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    if (!$data) {
        header("Location: index.php");
    }

    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $keterangan = $_POST['keterangan'];

        $query = "UPDATE `kategori` SET `nama`='$nama',`keterangan`='$keterangan' ,`updated_at`= NOW() WHERE `id` = $id ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "
            <script>
                alert('Data berhasil diubah.');
                window.location.href = 'index.php?page=kategori';
            </script>
        ";
        } else {
            echo "
            <script>
                alert('Data gagal diubah.');
            </script>
        ";
        }
    }
} else {
    header("Location: index.php");
}







?>

<div class="d-flex justify-content-center mt-5">
    <div class="card" style="width: 70rem">
        <div class="card-header">
            <h3>
                Edit Kategori
            </h3>
        </div>
        <form action="" method="POST">
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $data['nama'] ?>" required placeholder="Masukan nama kategori">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" required><?= $data['keterangan'] ?></textarea>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-end">
                    <a href="./index.php?page=kategori"> <i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" name="update" class="btn btn-primary ms-2">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>