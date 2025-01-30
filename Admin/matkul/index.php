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
            // $koneksi = mysqli_connect('localhost','root','','kodegenerator');
            $query = mysqli_query($mysqli, "SELECT max(id_matkul) as kodeTerbesar FROM matkul");
            $data = mysqli_fetch_array($query);
            $kodeMatkul = $data['kodeTerbesar'];
            $urutan = (int) substr($kodeMatkul, 3, 3);
            $urutan++;
            $huruf = "M";
            $kodeMatkul = $huruf . sprintf("%03s", $urutan);
            ?>
                <input type="hidden" name="id" value="<?php echo $kodeMatkul ?>" required>
                <input type="text" name="matkul" placeholder="Masukan Nama Matkul" required>
                <input type="text" name="sks" placeholder="Masukan Jumlah SKS" required>
                <input type="text" name="smester" placeholder="Masukan Smester" required>
                <select name="id_dosen" required>
                <?php 
                    $sql = "SELECT * FROM dosen";
                    $all_categories = mysqli_query($mysqli,$sql);
                            while ($category = mysqli_fetch_array(
                                    $all_categories,MYSQLI_ASSOC)):; 
                        ?>
                            <option value="<?php echo $category["id_dosen"];
                            ?>">
                                <?php echo $category["nama_dosen"];
                                ?>
                            </option>
                        <?php 
                            endwhile; 
                        ?>
                        <?php 
                        ?>
                    </select>
                <input type="submit" value="Tambah Matkul">
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
                <th>Matkul</th>
                <th>Jumlah SKS</th>
                <th>Smester</th>
                <th>Dosen</th>
                <th>Aksi</th>
            </tr>
            <?php 
                $query = "SELECT * FROM matkul inner join dosen on dosen.id_dosen=matkul.id_dosen";

                if ($result = $mysqli->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $field1name = $row["nm_matkul"];
                        $field2name = $row["sks"];
                        $field3name = $row["smester"];
                        $field4name = $row["nama_dosen"];
                        $field5name = $row["id_matkul"];

                        echo '<tr> 
                                <td>'.$field1name.'</td> 
                                <td>'.$field2name.'</td> 
                                <td>'.$field3name.'</td> 
                                <td>'.$field4name.'</td>
                                <td><a href="hapus.php?id='.$field5name.'">Hapus</a></td>
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