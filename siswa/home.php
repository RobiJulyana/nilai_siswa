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
                $sql=mysqli_query($mysqli,"SELECT users.name, 
                siswa.nim, siswa.nama, siswa.alamat, siswa.fakultas, matkul.smester FROM users 
                inner join siswa on siswa.nim=users.username 
                inner join detail_matkul on detail_matkul.nim=siswa.nim 
                inner join matkul on matkul.id_matkul=detail_matkul.id_matkul 
                where users.username='$username'");
                    while ($data=mysqli_fetch_array($sql)) {
            ?>
                <h1>Selamat Datang <?php echo $data['name']?></h1>
                <p>NIM : <?php echo $data['nim']?></p>
                <p>Alamat : <?php echo $data['alamat']?></p>
                <p>Smester : <?php echo $data['smester']?></p>
                <p>Fakultas : <?php echo $data['fakultas']?></p>
            <?php
                }
            ?>
        </div>
    </div>
    <br>
    <br>
    <div class="box">
        <div class="calculator">
        <?php 
                $sql=mysqli_query($mysqli,"SELECT SUM(CASE
                                                        WHEN nilai= 'A' THEN 4*matkul.sks
                                                        WHEN nilai= 'B' THEN 3*matkul.sks
                                                        WHEN nilai= 'C' THEN 2*matkul.sks
                                                        WHEN nilai= 'D' THEN 1*matkul.sks
                                                        ELSE
                                                        0*matkul.sks
                                                        END)/SUM(matkul.sks)
                                                        AS ipk
                                                        FROM detail_matkul
                                                        inner join matkul on matkul.id_matkul=detail_matkul.id_matkul
                                                        WHERE detail_matkul.nim='$username'
                                                        GROUP BY detail_matkul.nim");
                    while ($data=mysqli_fetch_array($sql)) {
            ?>
                <h3>IPK Anda Adalah  :  <?php echo $data['ipk']?></h3>
            <?php
            }
        ?>
        </div>
    </div>
    <br>
    <br>
    <div class="box">
        <div class="calculator">
            <form method="post" action="nilai.php">
                <center><select name="smester" required>
                            <option value=""> Pilih Smester</option>
                            <option value="Smester 1"> Smester 1</option>
                            <option value="Smester 2"> Smester 2</option>
                            <option value="Smester 3"> Smester 3</option>
                            <option value="Smester 4"> Smester 4</option>
                            <option value="Smester 5"> Smester 5</option>
                            <option value="Smester 6"> Smester 6</option>
                            <option value="Smester 7"> Smester 7</option>
                            <option value="Smester 8"> Smester 8</option>
                            <option value="Smester 9"> Smester 9</option>
                            <option value="Smester 10"> Smester 10</option>
                        </select>    
                </center>
                <input type="submit" value="Cari">
            </form>
        </div>
    </div>
</body>
</html>