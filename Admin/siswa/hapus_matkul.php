<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "algoritma";
                        
try {

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
/* set the PDO error mode to exception */
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*sql to delete a record*/
$sql = "DELETE FROM detail_matkul WHERE id_detail='" . $_GET["id"] . "'";
/*use exec() because no results are returned*/
$conn->exec($sql);
echo "Record deleted successfully";
header('Location: index.php');
}
catch(PDOException $e)
{
echo $sql . "
" . $e->getMessage();
}
$conn = null;
?>
