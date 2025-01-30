<?php
include 'config.php'; 
include_once('../layout/title.php');
include_once('layout/header.php');

if(isset($_SESSION['username'])== 0) { /* Halaman ini tidak dapat diakses jika belum ada yang login */
	header('Location: index.php'); 
}
$username = $_SESSION['username'];
$smester = $_POST['smester'];
?>
    <head>
        <link rel="stylesheet" type="text/css" href="../style.css">
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
            <h2>Pencarian Nilai  <b><?php echo $smester; ?></b></h2>
        </div>
    </div>
    <br>
    <br>
        <br>
        <table class="table1">
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Absensi</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Total</th>
                <th>Nilai</th>
            </tr>
            <?php 
                $query = "SELECT 
                            detail_matkul.id_detail,
                            siswa.nim,
                            siswa.nama,
                            matkul.nm_matkul,
                            dosen.nama_dosen,
                            ifnull(detail_matkul.kehadiran,'0') as kehadiran,
                            ifnull(detail_matkul.tugas,'0') as tugas,
                            ifnull(detail_matkul.uts,'0') as uts,
                            ifnull(detail_matkul.uas,'0') as uas,
                            ifnull(detail_matkul.total,'0') as total,
                            ifnull(detail_matkul.kesimpulan,'0') as kesimpulan
                            FROM detail_matkul 
                            left join matkul on matkul.id_matkul=detail_matkul.id_matkul
                            left join dosen on dosen.id_dosen=matkul.id_dosen 
                            left join siswa on siswa.nim=detail_matkul.nim 
                            where siswa.nim='$username' and matkul.smester='$smester'";

                if ($result = $mysqli->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $field1name = $row["nim"];
                        $field2name = $row["nama"];
                        $field3name = $row["nm_matkul"];
                        $field4name = $row["nama_dosen"];
                        $field5name = $row["kehadiran"];
                        $field6name = $row["tugas"];
                        $field7name = $row["uts"];
                        $field8name = $row["uas"];
                        $field9name = $row["total"];
                        $field10name = $row["kesimpulan"];
                        $field11name = $row["kesimpulan"];
                        $field12name = $row["id_detail"];

                        echo '<tr> 
                                <td>'.$field1name.'</td> 
                                <td>'.$field2name.'</td> 
                                <td>'.$field3name.'</td> 
                                <td>'.$field4name.'</td> 
                                <td>'.$field5name.'</td> 
                                <td>'.$field6name.'</td> 
                                <td>'.$field7name.'</td>  
                                <td>'.$field8name.'</td>  
                                <td>'.$field9name.'</td>  
                                <td>'.$field10name.'</td>
                             </tr>';
                    }
                    $result->free();
                } 
            ?>
        </table>
        <!-- </div>
    </div> -->
</body>
</html>