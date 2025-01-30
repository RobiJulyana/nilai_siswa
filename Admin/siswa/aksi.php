<?php
include '../config.php'; 
include_once('../layout/title.php');
include_once('../layout/header.php');

if(isset($_SESSION['username'])== 0) { /* Halaman ini tidak dapat diakses jika belum ada yang login */
	header('Location: ../index.php'); 
}
$id = $_GET['id'];
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
            <form method="post" action="proses_matkul.php">
            <?php 
            $query = mysqli_query($mysqli, "SELECT max(id_detail) as kodeTerbesar FROM detail_matkul");
            $data = mysqli_fetch_array($query);
            $kodeMatkul = $data['kodeTerbesar'];
            $urutan = (int) substr($kodeMatkul, 2, 2);
            $urutan++;
            $huruf = "DM";
            $kodeMatkul = $huruf . sprintf("%02s", $urutan);
            ?>
                <input type="text" name="id_detail" value="<?php echo $kodeMatkul ?>" required readonly>
                <input type="text" name="nim" value="<?php echo $id ?>" required readonly>
                <?php 
                    $sql=mysqli_query($mysqli,"SELECT * FROM siswa where nim='$id'");
                    while ($data=mysqli_fetch_array($sql)) {
                    ?>
                    <input type="text" name="nama" value="<?php echo $data['nama']?>" readonly></center>
                    <?php
                    }
                ?>
                <select name="matkul" required>
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
                    </select>
                <input type="submit" value="Tambah Matkul Siswa">
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
                <th>NIM</th>
                <th>Nama</th>
                <th>Fakultas</th>
                <th>Matkul</th>
                <th>SKS</th>
                <th>Dosen</th>
                <th>Aksi</th>
            </tr>
            <?php 
                $query = "SELECT * FROM detail_matkul inner join matkul on matkul.id_matkul=detail_matkul.id_matkul
                            inner join dosen on dosen.id_dosen=matkul.id_dosen inner join siswa on siswa.nim=detail_matkul.nim where detail_matkul.nim='$id'";

                if ($result = $mysqli->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $field1name = $row["nim"];
                        $field2name = $row["nama"];
                        $field3name = $row["fakultas"];
                        $field4name = $row["nm_matkul"];
                        $field5name = $row["sks"];
                        $field6name = $row["nama_dosen"];
                        $field7name = $row["id_detail"];

                        echo '<tr> 
                                <td>'.$field1name.'</td> 
                                <td>'.$field2name.'</td> 
                                <td>'.$field3name.'</td> 
                                <td>'.$field4name.'</td> 
                                <td>'.$field5name.'</td> 
                                <td>'.$field6name.'</td> 
                                <td><a href="hapus_matkul.php?id='.$field7name.'">Hapus</a>
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