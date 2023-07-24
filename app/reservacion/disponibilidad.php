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
	$fecha=$_POST['fecha'];
	$sql="SELECT COUNT(*)  FROM reservaciones WHERE fecha='$fecha'";
    $res=$conectar->query($sql) or die ( mysqli_error());
    $nrows=mysqli_num_rows($res);
    list( $no_registros ) = mysqli_fetch_array($res);
    if( $no_registros <5  ) {
    	
    ?>
    	<form action="guardar_reservacion.php" method="POST" enctype="multipart/form-data">
                                                <center><table border="1">
                                                <tr bgcolor="skyblue">        
                                                    <td><strong>Personas:</strong></td><td> <input type="number" name="personas" value=""></td>
                                                </tr>
                                                <tr bgcolor="skyblue">        
                                                    <td><strong>fecha:</strong></td><td> <input type=»text» disabled=»disabled» name="fecha" value="<?php echo $fecha; ?>"></td>
                                                </tr>
                                                <tr bgcolor="skyblue">        
                                                    <td><strong>Hora:</strong></td><td> <input type="time" name="hora" "></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" align="center" bgcolor="skyblue">
                                                        <input type="submit" name="enviar" value="Aceptar">
                                                        <a href="desayuno_admi.php"><button type="button" name="Cancelar" value="cancelar">cancelar</button></a>
                                                    </td>
                                                </tr>
                                               
                                                </center></table>
                                            </form>    
    	
    <?php	

		
	}else{
		echo "lo sentimos, reservaciones superadas";
	}

	?>

</body>
</html>