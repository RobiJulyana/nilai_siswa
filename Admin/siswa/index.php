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
            $query = mysqli_query($mysqli, "SELECT max(nim) as kodeTerbesar FROM siswa");
            $data = mysqli_fetch_array($query);
            $kodeSiswa = $data['kodeTerbesar'];
            $urutan = (int) substr($kodeSiswa, 3, 3);
            $urutan++;
            $waktu = date('ym');
            $kodeSiswa = $waktu . sprintf("%03s", $urutan);
            ?>
                <input type="text" name="nim" value="<?php echo $kodeSiswa ?>" required readonly>
                <input type="text" name="nama" placeholder="Masukan Nama" required>
                <input type="text" name="alamat" placeholder="Masukan Alamat" required>
                <select name="jk" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <select name="agama" required>
                    <option value="">Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Keristen">Keristen</option>
                    <option value="Katholik">Katholik</option>
                    <option value="Budha">Budha</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
                <input type="text" name="lahir" placeholder="Masukan Tempat Lahir" required>
                <center><input type="date" name="tgl_lahir" required> </center>  
				<select name="fakultas" required>
                    <option value="">Pilih Fakultas</option>
                    <option value="FTK">FTK</option>
                    <option value="FTB">FTB</option>
                </select>
                <input type="text" name="email" placeholder="Masukan Email" required>
                <center><input type="number" name="hp" placeholder="+62" required></center>
				<input type="hidden" name="role" value="Siswa" required>
                <input type="hidden" name="password" value="123456" required>
				<input type="submit" value="Tambah Mahasiswa">
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
                <th>ALamat</th>
                <th>Agama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Aksi</th>
            </tr>
            <?php 
                $query = "SELECT * FROM siswa";

                if ($result = $mysqli->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $field1name = $row["nim"];
                        $field2name = $row["nama"];
                        $field3name = $row["alamat"];
                        $field4name = $row["jk"];
                        $field5name = $row["tgl_lahir"];
                        $field6name = $row["agama"];
                        $field7name = $row["lahir"];

                        echo '<tr> 
                                <td>'.$field1name.'</td> 
                                <td>'.$field2name.'</td> 
                                <td>'.$field3name.'</td> 
                                <td>'.$field6name.'</td> 
                                <td>'.$field4name.'</td> 
                                <td>'.$field7name.', '.$field5name.'</td>
                                <td><a href="hapus.php?id='.$field1name.'">Hapus</a><br>
                                    <a href="aksi.php?id='.$field1name.'">Aksi</a></td>
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