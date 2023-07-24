<?php
require 'conexion.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php
	$personas=$_POST['personas'];
    $fecha=$_REQUEST['fecha'];
    $hora=$_POST['hora'];
    $res=$conectar->query("INSERT into reservaciones('personas','fecha','hora') values ('$personas','$fecha','$hora')") or die ( mysqli_error());
   
    if( $res) {
    	header("Location: user_login.php");
    

		
	}else{
		echo "error al realizar la reservacion";
	}

	?>

</body>
</html>