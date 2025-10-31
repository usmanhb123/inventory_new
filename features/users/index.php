<?php
$keyword = $_POST['keyword'] ?? '';

if (isset($_POST['cari'])) {
    $safeKeyword = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM `users` WHERE `name` LIKE '%$safeKeyword%' OR `username` LIKE '%$safeKeyword%' OR `email` LIKE '%$safeKeyword%'";
    $result = mysqli_query($conn, $query);
    $users = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
} else {
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM `users` WHERE `id` =  $id ";
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
    $data = mysqli_query($conn, "SELECT * FROM users");
    $users = $data ? mysqli_fetch_all($data, MYSQLI_ASSOC) : [];
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Data Users</h3>
            <div class="row">
                <div class="col-md-6">
                    <form class="d-flex" action="" method="post">
                        <input class="form-control me-2" type="search" value="<?= htmlspecialchars($keyword, ENT_QUOTES) ?>" name="keyword" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="text-end">
                        <a href="app?page=users&view=add" class="btn btn-primary btn-sm"> <i class="fa-solid fa-plus"></i> Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <?php if ($users) : ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Dibuat</th>
                                    <th>Login Terakhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $no => $user): ?>
                                    <tr>
                                        <td><?= $no + 1 ?></td>
                                        <td><?= htmlspecialchars($user['name']) ?></td>
                                        <td><?= htmlspecialchars($user['username']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td><?= $user['created_at'] ? date('d-m-Y H:i', strtotime($user['created_at'])) : '-' ?></td>
                                        <td><?= $user['logged_in_at'] ? date('d-m-Y H:i', strtotime($user['logged_in_at'])) : '-' ?></td>
                                        <td>
                                            <a href="./index.php?page=users&view=edit&id=<?= $user['id'] ?>" class="btn btn-warning btn-sm"> <i class="fa-solid fa-pen"></i> edit</a>
                                            <form action="" method="post" style="display: inline;" onsubmit="return confirm('anda akan menghapus data user?')">
                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
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
                        <img src="./assets/images/image.png" alt="" width="400" srcset="">
                        <h1>Tidak ada data</h1>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>
