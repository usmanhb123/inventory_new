<?php include('./config/db.php') ?>
<?php include('./layouts/header.php'); ?>
<?php

if (isset($_SESSION['user'])) {
    header('Location: app');
    exit;
}



if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cekusername = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cekusername) > 0) {
        $user = mysqli_fetch_assoc($cekusername);
        $cekpassword = password_verify($password, $user['password']);
        if ($cekpassword) {
            $_SESSION['user'] = $user;  // ini untuk menambahkan session
            mysqli_query($conn, "UPDATE users SET logged_in_at = NOW() WHERE username = '$username'");
            header('Location: app');
            exit;
        } else {
            echo "<script> alert('Password salah') </script>";
        }
    } else {
        echo "<script> alert('Username tidak ditemukan') </script>";
    }
}




?>

<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center">
                        <img src="assets/images/logo-dark.svg" alt="image" class="img-fluid brand-logo" />
                    </a>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="auth-header">
                                <h2 class="text-secondary mt-5"><b>Hi, Welcome Back</b></h2>
                                <p class="f-16 mt-2">Enter your credentials to continue</p>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="username" placeholder=" Username" required />
                            <label for="floatingInput"> Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingInput1" name="password" placeholder="Password" required />
                            <label for="floatingInput1">Password</label>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" name="login" class="btn btn-secondary">Sign In</button>
                        </div>
                        <div class="text-center mt-4">

                            <a href="index" class="mt-2">Kembali ke web</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div
    <?php include('./layouts/footer.php'); ?>