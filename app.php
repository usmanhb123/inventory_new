<?php include('./config/db.php') ?>
<?php
    if (!isset($_SESSION['user'])) {
        header('Location: login');
        exit;
    }
?>
<!-- file header -->
<?php include('./layouts/header.php'); ?>

<!-- [ Sidebar Menu ] start -->

<!-- file navbar -->
<?php include('./layouts/navbar.php'); ?>
<!-- [ Sidebar Menu ] end -->



<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">

        <?php

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 'home';
        }
        if (isset($_GET['view'])) {
            $view = $_GET['view'];
        } else {
            $view = 'index';
        }
        $feature = "./features/$page/$view.php";


        // cek file nya beneran ada apa tidak
        if (file_exists($feature)) { // file exists itu untuk mengecek apakah path dan file beneran ada apa tidak
            include($feature);
        } else {
            include('./404.php');
        }

        ?>
    </div>
</div>
<!-- file footer -->
<?php include('./layouts/footer.php'); ?>