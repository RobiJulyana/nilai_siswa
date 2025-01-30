<?php
include 'config.php'; 
include '../layout/title_home.php';
include 'layout/header.php';

if(isset($_SESSION['username'])== 0) { /* Halaman ini tidak dapat diakses jika belum ada yang login */
	header('Location: index.php'); 
}
$username = $_SESSION['username'];
?>
<head>
        <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="calculator">
            <?php 
                $sql=mysqli_query($mysqli,"SELECT * FROM users where username='$username'");
                    while ($data=mysqli_fetch_array($sql)) {
            ?>
                <h1>Selamat Datang <?php echo $data['name']?></h1>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>