<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO `kategori`(`nama`, `keterangan`) VALUES ('$nama','$keterangan')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "
            <script>
                alert('Data berhasil disimpan.');
                window.location.href = 'index.php?page=kategori';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data gagal disimpan.');
            </script>
        ";

    }
}

?>

<div class="d-flex justify-content-center mt-5">
    <div class="card" style="width: 70rem">
        <div class="card-header">
            <h3>
                Tambah Barang
            </h3>
        </div>
        <form action="" method="POST">
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan nama kategori">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-end">
                    <a href="./index.php?page=kategori"> <i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-primary ms-2">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>