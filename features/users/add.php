<?php
if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($name === '' || $username === '' || $email === '' || $password === '') {
        echo "
            <script>
                alert('Semua field wajib diisi.');
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
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO `users`(`name`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES ('$safeName','$safeUsername','$hashedPassword','$safeEmail', NOW(), NOW())";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo "
                    <script>
                        alert('Data berhasil disimpan.');
                        window.location.href = 'index.php?page=users';
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
    }
}
?>

<div class="d-flex justify-content-center mt-5">
    <div class="card" style="width: 70rem">
        <div class="card-header">
            <h3>
                Tambah User
            </h3>
        </div>
        <form action="" method="POST">
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukan nama" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukan username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukan email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukan password" required>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-end">
                    <a href="./index.php?page=users"> <i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-primary ms-2">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
