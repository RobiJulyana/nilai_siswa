<?php 
include '../config.php'; 

		$sql_hapus = mysqli_query ($mysqli, "DELETE FROM siswa WHERE nim='" . $_GET["id"] . "'");
		if($sql_hapus){
			$sql_hapus1 = mysqli_query ($mysqli, "DELETE FROM users WHERE username='" . $_GET["id"] . "'");

		echo "Data berhasil dihapus";
		header('Location: index.php'); 
		exit;
		} else {
		 echo "Data gagal dihapus";
		}
		
?>
