<?php
include '../config.php'; 
include_once('../layout/title.php');
include_once('../layout/header.php');

if(isset($_SESSION['username'])== 0) { /* Halaman ini tidak dapat diakses jika belum ada yang login */
	header('Location: ../index.php'); 
}
?>
    <head>
        <link rel="stylesheet" type="text/css" href="../../style.css">
    <style>
    .table1 {
        font-family: sans-serif;
        color: #444;
        border-collapse: collapse;
        width: 50%;
        border: 1px solid #f2f5f7;
        margin-left: auto;
        margin-right: auto;

    }
             
    .table1 tr th{
        background: #35A9DB;
        color: #fff;
        font-weight: normal;
    }
             
    .table1, th, td {
        padding: 8px 20px;
        text-align: center;
    }
             
    .table1 tr:hover {
        background-color: #f5f5f5;
    }
             
    .table1 tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    </style>
</head>
<body>
    <br>
    <br>
    <br>
    <div class="box">
        <div class="calculator">
            <form method="post" action="proses.php">
            <?php 
            $query = mysqli_query($mysqli, "SELECT max(id_dosen) as kodeTerbesar FROM dosen");
            $data = mysqli_fetch_array($query);
            $kodeDosen = $data['kodeTerbesar'];
            $urutan = (int) substr($kodeDosen, 3, 3);
            $urutan++;
            $huruf = "D";
            $kodeDosen = $huruf . sprintf("%03s", $urutan);
            ?>
                <input type="hidden" name="id" value="<?php echo $kodeDosen ?>" required>
                <input type="text" name="dosen" placeholder="Masukan Nama Dosen" required>
                <input type="text" name="alamat" placeholder="Masukan Alamat Dosen" required>
                <!-- <select name="id_matkul" required>
                <?php 
                    $sql = "SELECT * FROM matkul";
                    $all_categories = mysqli_query($mysqli,$sql);
                            while ($category = mysqli_fetch_array(
                                    $all_categories,MYSQLI_ASSOC)):; 
                        ?>
                            <option value="<?php echo $category["id_matkul"];
                            ?>">
                                <?php echo $category["nm_matkul"];
                                ?>
                            </option>
                        <?php 
                            endwhile; 
                        ?>
                        <?php 
                        ?>
                    </select> -->
                <input type="text" name="email" placeholder="Masukan Email" required>
                <input type="hidden" name="role" value="Dosen" required>
                <input type="hidden" name="password" value="123456" required>
				<input type="submit" value="Tambah Dosen">
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="box">
        <div class="calculator">
        <br>
        <table class="table1">
            <tr>
                <th>ID Dosen</th>
                <th>Nama Dosen</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php 
                $query = "SELECT * FROM dosen";

                if ($result = $mysqli->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $field1name = $row["nama_dosen"];
                        $field2name = $row["alamat"];
                        $field3name = $row["id_dosen"];

                        echo '<tr> 
                                <td>'.$field3name.'</td>
                                <td>'.$field1name.'</td> 
                                <td>'.$field2name.'</td>
                                <td><a href="hapus.php?id='.$field3name.'">Hapus</a></td>
                             </tr>';
                    }
                    $result->free();
                } 
            ?>
        </table>
        </div>
    </div>
</body>
</html>