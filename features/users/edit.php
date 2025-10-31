<?php
if (!isset($_GET['id'])) {
    header('Location: index.php?page=users');
    exit;
}

$id = (int) $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$user = $result ? mysqli_fetch_assoc($result) : null;

if (!$user) {
    echo "
        <script>
            alert('Data tidak ditemukan.');
            window.location.href = 'index.php?page=users';
        </script>
    ";
    exit;
}

if (isset($_POST['update'])) {
    $name = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || $username === '' || $email === '') {
        echo "
            <script>
                alert('Nama, Username, dan Email wajib diisi.');
            </script>
        ";
    } else {
        $safeName = mysqli_real_escape_string($conn, $name);
        $safeUsername = mysqli_real_escape_string($conn, $username);
        $safeEmail = mysqli_real_escape_string($conn, $email);

        $checkUsername = mysqli_query($conn, "SELECT id FROM users WHERE username = '$safeUsername' LIMIT 1");

        if ($checkUsername && mysqli_num_rows($checkUsername) > 0) {
            echo "
                <script>
                    alert('Username sudah digunakan, pilih username lain.');
                </script>
            ";
        } else {

            if ($password !== '') {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE `users` SET `name`='$safeName', `username`='$safeUsername', `email`='$safeEmail', `password`='$hashedPassword', `updated_at`= NOW() WHERE `id` = $id";
            } else {
                $updateQuery = "UPDATE `users` SET `name`='$safeName', `username`='$safeUsername', `email`='$safeEmail', `updated_at`= NOW() WHERE `id` = $id";
            }

            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                echo "
                <script>
                    alert('Data berhasil diubah.');
                    window.location.href = 'index.php?page=users';
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
    }
}
?>

<div class="d-flex justify-content-center mt-5">
    <div class="card" style="width: 70rem">
        <div class="card-header">
            <h3>
                Edit User
            </h3>
        </div>
        <form action="" method="POST">
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Biarkan kosong jika tidak ingin mengganti password">
                </div>
            </div>
            <div class="card-footer">
                <div class="text-end">
                    <a href="./index.php?page=users"> <i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" name="update" class="btn btn-primary ms-2">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>