<!DOCTYPE html>
<html>
	
	<head>
		
		<meta charset="UTF-8">
			<title>Borrado de libros</title>

	</head>
		
			<style type="text/css">
				html{
					width: 100%;
					height: 100%;
				}

				body{
					background-image: url("bicho.jpg");
					background-size: 100% 100%;
				}

			</style>

		<body>

			<h1>LISTA DE LIBROS</h1>
			
			<form action="borrar.php" method="get">


			<label>Lista de libros:</label><br>
			 
			 <select name='idlibros'> <!-- Esto es lo que se envia al script de borrado para que sepa que esta seleccionado en el select -->

			<?php

				include ('conexion.php');

				// Create connection
				$conn = mysqli_connect($servername, $username, $password, $dbname); //hacemos la conexion con la base de datos con los datos que pusimos arriba
				
				$consulta = "SELECT * FROM libros";
				$resultado = mysqli_query($conn, $consulta) or die(mysqli_error($conn));

				foreach ($resultado as $opciones) {
					# code...
					echo "<option value=" . $opciones['idlibros'] . ">" .$opciones['titulo'] . "</option>"; 
				}
			
        ?>
	</select>

	<input type="submit" name="borrar" value="borrar">

	
</form>
	
			
		</body>
</html>