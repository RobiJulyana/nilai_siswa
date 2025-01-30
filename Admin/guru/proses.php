<?php 
include '../config.php'; 

		$dosen 		= $_POST['dosen'];
		$alamat 	= $_POST['alamat'];
		$id 		= $_POST['id'];
		$role 		= $_POST['role'];
		$password 	= md5($_POST['password']."ALS52KAO09");
		$email 		= $_POST['email'];

		$sql_simpan = mysqli_query ($mysqli, "INSERT into users (username,password,name,email,role) 
			VALUES ('$id','$password','$dosen','$email','$role')");
		if($sql_simpan){
		$sql_simpan1 = mysqli_query ($mysqli, "INSERT into dosen (id_dosen,nama_dosen,alamat) 
		VALUES ('$id','$dosen','$alamat')");

		echo "Data berhasil disimpan";
		header('Location: index.php'); 
		exit;
		} else {
		 echo "Data gagal disimpan";
		}
		
		?>