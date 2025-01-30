<?php 
include '../config.php'; 

		$id_detail 	= $_POST['id_detail'];		
		$id 		= $_POST['nim'];
		$matkul 	= $_POST['matkul'];

			$sql_simpan = mysqli_query($mysqli,"INSERT INTO detail_matkul values('$id_detail','$id','$matkul','-','0','0','0','0','0','Belum Ada Nilai','-','0')");
		if($sql_simpan) {
			echo "Data berhasil disimpan";
			header('Location: aksi.php?id='.$id.''); 
			exit;
		} else {
			echo "Data gagal disimpan";
			// header('Location: aksi.php?id='.$id.''); 
		}
?>