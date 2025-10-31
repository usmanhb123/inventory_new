<?php
// proses simpan data barang
if (isset($_POST['simpan'])) {
    $kategori_id = $_POST['kategori'];
    $ruangan_id  = $_POST['ruangan'];
    $kode        = $_POST['kode'];
    $nama        = $_POST['nama'];
    $keterangan  = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';

    $query = "INSERT INTO `barang`(`kategori_id`, `ruangan_id`, `kode`, `nama`, `keterangan`) VALUES ( '$kategori_id', '$ruangan_id', '$kode', '$nama', '$keterangan')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "
            <script>
                alert('Data berhasil disimpan.');
                window.location.href = 'app?page=barang';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal disimpan.');
            </script>
        ";
    }
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

                Tambah Barang
            </h3>
        </div>
        <form action="" method="POST">
            <div class="card-body">

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option value="">Pilih kategori</option>
                        <?php foreach ($kategories as $k): ?>
                            <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukan Kode">
                        </div>
                    </div>
                    <div class="col">

                        <div class="mb-3">
                            <label for="nama" class="form-label">Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Barang">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="ruangan" class="form-label">Ruangan</label>
                    <select class="form-select" id="ruangan" name="ruangan" aria-label="Default select example">
                        <option value="">Pilih kategori</option>
                        <?php foreach ($ruangan as $r): ?>
                            <option value="<?= $r['id'] ?>">Lt <?= $r['lantai'] ?> - <?= $r['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukan keterangan (opsional)"></textarea>
                </div>
                <div class="mb-3">
                    <label for="qty" class="form-label">Qty</label>
                    <input type="number" class="form-control" id="qty" placeholder="Masukan Qty">
                </div>

            </div>
            <div class="card-footer">
                <div class="text-end">
                    <a href="./index.php"> <i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-primary ms-2">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>