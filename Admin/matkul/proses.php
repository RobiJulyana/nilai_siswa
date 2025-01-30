<?php 
include '../config.php'; 

		$matkul 	= $_POST['matkul'];
		$sks 		= $_POST['sks'];
		$smester 	= $_POST['smester'];
		$id_dosen 	= $_POST['id_dosen'];
		$id 		= $_POST['id'];

		$sql_simpan = mysqli_query ($mysqli, "INSERT into matkul (id_matkul,nm_matkul,sks,id_dosen,smester) 
		VALUES ('$id','$matkul','$sks','$id_dosen','$smester')");
		if($sql_simpan) {
		 echo "Data berhasil disimpan";
		 header('Location: index.php'); 
		 exit;
		} else {
		 echo "Data gagal disimpan";
		}
		?>