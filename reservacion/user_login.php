<?php
require 'conexion.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body style="background-color: #FA9546 ">

    <div class="container">
        <div class="row">
            

           <h1 style="text-align: center;  ">Reservaciones</h1>

           <form action="disponibilidad.php" method="POST">
            <tr bgcolor="skyblue">        
                    <td><h2>Fecha:</h2></td><td> <input type="date" name="fecha" value="" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>></td>
                </tr>
                <a href=""><input type="submit" name="" value="verificar"></a>
           </form>

</body>
</html>
    

	

	
