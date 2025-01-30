<?php
include 'config.php'; 
include '../layout/title_home.php';
include 'layout/header.php';

if(isset($_SESSION['username'])== 0) { /* Halaman ini tidak dapat diakses jika belum ada yang login */
	header('Location: index.php'); 
}

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
        <h1>Selamat Datang <?php echo $_SESSION['username']; ?></h1>
        </div>
    </div>
</body>
</html>