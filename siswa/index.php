<?php 
//error_reporting(0);
include_once('../layout/title.php');
include_once('../layout/header.php');
include 'config.php';

if(!isset($_SESSION['username'] )== 0) {
	header('Location: home.php');
}

if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']."ALS52KAO09");
	$role = $_POST['role'];

	try {
		$sql = "SELECT * FROM users WHERE username = :username AND password = :password AND role = :role";
		$stmt = $connect->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':role', $role);
		$stmt->execute();

		$count = $stmt->rowCount();
		if($count == 1) {
			$_SESSION['username'] = $username;
			header("Location: home.php");
			return;
		}else{
			echo "Anda tidak dapat login";
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}

?>
<head>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <br>
    <br>
    <br>
	<div class="container">
    	<div class="box">
			<div class="calculator">
			<center><h2><b>Login Siswa</b></h2></center>
				<form method="post" action="">
					<input type="text" name="username" placeholder="Masukan NIM" required>
					<input type="text" name="password" placeholder="Masukan Password" required>
					<input type="hidden" name="role" value="Siswa" required>
					<br>
					<input type="submit" name="login"class="bg-blue" value="Login">
					<input type="reset" name="reset" class="bg-red" value="Reset">
					<br>
					<!-- <br><center><a href="register.php">Register</a></center> -->
				</form>
			</div>
		</div>
    </div>
</body>
</html>