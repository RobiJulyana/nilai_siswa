<?php 
include '../config.php'; 

		$nim 		= $_POST['nim'];
		$nama 		= $_POST['nama'];
		$alamat 	= $_POST['alamat'];
		$jk 		= $_POST['jk'];
		$agama 		= $_POST['agama'];
		$lahir 		= $_POST['lahir'];
		$tgl_lahir 	= $_POST['tgl_lahir'];
		$fakultas 	= $_POST['fakultas'];
		$role 		= $_POST['role'];
		$password 	= md5($_POST['password']."ALS52KAO09");
		$email 		= $_POST['email'];
		$hp 		= $_POST['hp'];

		$sql_simpan = mysqli_query ($mysqli, "INSERT into users (username,password,name,email,role) 
			VALUES ('$nim','$password','$nama','$email','$role')");
		if($sql_simpan){
		$sql_simpan1 = mysqli_query ($mysqli, "INSERT into siswa (nim,nama,alamat,jk,agama,lahir,tgl_lahir,fakultas) 
			VALUES ('$nim','$nama','$alamat','$jk','$agama','$lahir','$tgl_lahir','$fakultas')");
		
		 echo "Data berhasil disimpan";
		 header('Location: index.php'); 
		 exit;
		} else {
		 echo "Data gagal disimpan";
		}
		?>