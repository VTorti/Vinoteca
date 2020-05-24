<!DOCTYPE html>

<?php

			include ('conexion.php');
					   //Create connection
					  $conn = mysqli_connect($servername, $username, $password, $dbname);
					  // Check connection
					  if (!$conn) {
					      die("Connection failed: " . mysqli_connect_error());
					  }
			$conn->set_charset("utf8");

			function test_input($data) {
            $clear_data = trim($data);
            $clear_data = stripslashes($clear_data);
            $clear_data = htmlspecialchars($clear_data);
            return $clear_data;
        	}

        	//id_pelicula 	titulo 	fechaEstreno 	director 	genero 	url 	nacionalidad 	telefono 	imagen 	fechaPrestamo
      		$nombreErr = $bodegaErr = $tipoErr = $cosechaErr = $eanErr = $precioErr = $disponibleErr= $provErr = $nombreFotoErr = $archivoErr= "";
         	$nombre = $bodega = $tipo = $cosecha = $ean = $precio = $prov = $disponible = $nombreFoto = "";
        	$formularioValido = true;

			if(count($_POST) > 0){
				$nombre = $_POST['nombre'];
				$bodega = $_POST['bodega'];
				$tipo =$_POST['tipo'];
				$cosecha = $_POST['cosecha'];
				$ean = $_POST['ean'];
				$precio = $_POST['precio'];
				$disponible = $_POST['disponible'];
				$prov=$_POST['provincia'];
				$nombreFoto=$_FILES['fileToUpload']['name'];

				if(empty($tipo)){
				$tipo="";
				}
				
				
				$target_dir = "imagenes/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					
					if(isset($_POST["submit"])) {
					  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					  if($check !== false) {
					    
					    $uploadOk = 1;
					  } else {
					    $nombreFotoErr= "El archivo no es una imagen";
					    $uploadOk = 0;
					    $formularioValido = false;
					  }
					}

					
					if (file_exists($target_file)) {
					  	$nombreFotoErr= "El archivo ya existe";
					    $uploadOk = 0;
					    $formularioValido = false;
					}

					
					if ($_FILES["fileToUpload"]["size"] > 500000) {
					    $nombreFotoErr= "El archivo es muy grande";
					    $uploadOk = 0;
					    $formularioValido = false;
					}

					
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					 
						$nombreFotoErr= "Sólo jpg, jpeg, png o gif";
					    $uploadOk = 0;
					    $formularioValido = false;
					}

					
					if ($uploadOk == 0) {
					  $archivoErr= "La foto no fue subida";
					
					}  
					
				
				
				

				if ($nombre == "") {
					$nombreErr = "Nombre es requerido";
                	$formularioValido = false;
					
				}
				else{
					if (strlen($nombre) > 45) {
						$nombreErr = "El campo nombre no puede tener mas de 45 carácteres";
                    	$formularioValido = false;
						
					}				
				}

				if ($bodega == "") {
					$bodegaErr = "Bodega es requerido";
                	$formularioValido = false;
					
				}
				else{
					if (strlen($bodega) > 45) {
						$bodegaErr = "El campo bodega no puede tener mas de 45 carácteres";
                    	$formularioValido = false;
						
					}
				}

				if ($precio == "") {
					$precioErr = "Precio es requerido";
                	$formularioValido = false;
					
				}
				else{
					if ($precio<=0) {
						$bodegaErr = "El precio no puede ser negativo";
                    	$formularioValido = false;
						
					}
				}

				if ($tipo=="") {
					$tipoErr = "Tipo es requerido";
                	$formularioValido = false;
				}
				
					
					if ($disponible == "SI") {
						$disponible = 1;
						
					}
					else {
						$disponible = 0;
					}
				

				if ($ean == "") {
					$eanErr = "EAN es requerido";
                	$formularioValido = false;
				}
				else{
					$cc = substr($ean, -1);
					$c = substr($ean, 0,12);
					if (strlen($ean) > 13) {
						$eanErr = "EAN no puede tener más de 13 números";
                		$formularioValido = false;
					}
					else{
						$TSumaI = 0;
						$TSumaP = 0;
						$SumaTotal = 0;
						$resto = 0;
						$DC = 0;
						for ($i=0; $i < strlen($ean)-1; $i++) { 
							if ($i%2==0) {
								$num = substr($ean, $i, 1);
								$num = $num * 1;
								$TSumaI = $TSumaI + $num;
							}
							else{
								$num = substr($ean, $i, 1);
								$num = $num * 3;
								$TSumaP = $TSumaP + $num;
							}
						}
						$SumaTotal = $TSumaP + $TSumaI;
						$resto = $SumaTotal%10;
						$DC = 10 - $resto;
						if ($cc!=$DC) {
							$eanErr = "EAN no válido";
                			$formularioValido = false;
						}
					}
				}
			}

			if (count($_POST) > 0 && $formularioValido) {
                ini_set('date.timezone', 'Europe/Madrid');
  
 						$fechaAlta=date('Y-m-d h:i:s',time());

								    	$sql = "INSERT INTO vinos (nombre,bodega,tipo,disponible,cosecha,ean,fechaAlta,precio,imagen,provincia)
					  VALUES ('$nombre', '$bodega', '$tipo','$disponible', '$cosecha', '$ean', '$fechaAlta', '$precio','$nombreFoto', '$prov')";
					  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

                if ($conn->query($sql) === TRUE) {
                    
                    header("Location: consulta.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }


            
        }

    

				

				
		?>
<html lang="en">
<title>Bodega</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-highway.css">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
.error{
			background-color: red;
			color: white;
			font-size: 12px;
			padding: 10px;
			margin-bottom: 10px;
			width: 40em;
		}
		.correcto{
			background-color: green;
			color: white;
			font-size: 12px;
			padding: 10px;
			margin-bottom: 10px;
			width: 40em;
		}
		form{
			background-image: url(vaso.jpg);
			background-repeat: no-repeat;
			background-size:170%;
			margin-bottom:0%;
			width:100%;

		}
</style>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-highway-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Cerrar Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding"><b>Vinoteca</b></h3>
  </div>
  <div class="w3-bar-block">
    <a href="alta.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Dar de alta un vino</a> 
    <a href="consulta.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Consulta nuestros vinos</a> 
    <a href="consultaColor.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Consulta un vino por color</a> 
    <a href="buscaCadena.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Busque un vino por nombre</a>
    <a href="buscaPrecio.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Consulte un vino por precios</a> 
    <a href="menu.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Página principal</a>
  </div>
</nav>


<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-highway-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-highway-red w3-margin-right" onclick="w3_open()">☰</a>
  <span>Vinoteca</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
	

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px;margin-top:40px">
<form action="" method="post" enctype="multipart/form-data">
<!--Formulario-->
<div class="w3-card-4 w3-section">
  <div class="w3-container w3-highway-red" id="alta" style="margin-top:100px">
    <h2>Añade tu vino</h2>
  </div>
  <form class="w3-display-container w3-text-black" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
  	

    <p>      
    <label class="w3-text" style="margin-left:20px;color:#a7001a"><b>Nombre</b></label>
    <input class="w3-input w3-border w3-sand w3-display-top" name="nombre" value="<?php echo $nombre; ?>" type="text" required style="margin-left:20px;width:90%" autofocus="autofocus" placeholder="Nombre del vino"><span class="w3-text-red" style="margin-left:20px"><?php echo $nombreErr;?></span></p>
    <p>      
    <label class="w3-text" style="margin-left:20px;color:#a7001a"><b>Bodega</b></label>
    <input class="w3-input w3-border w3-sand" name="bodega" value="<?php echo $bodega; ?>" type="text" required style="margin-left:20px;width:90%" placeholder="Bodega"><span class="w3-text-red" style="margin-left:20px"><?php echo $bodegaErr;?></span></p>
    <p>      
    <label class="w3-text" style="margin-left:20px;color:#a7001a" required><b>Tipo</b></label>
    <input type="radio" name="tipo" value="Tinto" <?php if (isset($tipo) && $tipo=="Tinto") echo 'checked';?>>Tinto
	<input type="radio" name="tipo" value="Blanco" <?php if (isset($tipo) && $tipo=="Blanco") echo 'checked';?>>Blanco
	<input type="radio" name="tipo" value="Rosado" <?php if (isset($tipo) && $tipo=="Rosado") echo 'checked';?>>Rosado
	<input type="radio" name="tipo" hidden value=""<?php if ($tipo=="") echo "checked";?>>
    <span class="w3-text-red" style="margin-left:20px"><?php echo $tipoErr;?></span></p>
    <p>      
    <label class="w3-text" style="margin-left:20px;color:#a7001a"><b>Disponible</b></label>
    <select name="disponible" value="<?php echo $dispnible?>" required  style="margin-left:20px">
    <option value="1">Sí</option>
	<option value="0">No</option>
	
	</select>
	<span class="w3-text-red" style="margin-left:20px"> <?php echo $disponibleErr; ?></span></p>
	<p>      
    <label class="w3-text" style="margin-left:20px;color:#a7001a"><b>Cosecha</b></label>
    <input class="w3-input w3-border w3-sand" name="cosecha" value="<?php echo $cosecha?>" type="date" style="margin-left:20px;width:90%"><span class="w3-text-red" style="margin-left:20px"> <?php echo $cosechaErr; ?></span></p>
    <p>      
    <label class="w3-text" style="margin-left:20px;color:#a7001a"><b>EAN</b></label>
    <input class="w3-input w3-border w3-sand" name="ean" value="<?php echo $ean?>" type="text" maxlength="13"required style="margin-left:20px;width:90%" placeholder="EAN"><span class="w3-text-red" style="margin-left:20px"> <?php echo $eanErr;?></span></p>
    <p>
    <label class="w3-text" style="margin-left:20px;color:#a7001a"><b>Precio</b></label>
    <input class="w3-input w3-border w3-sand" name="precio" value="<?php echo $precio?>" type="float" maxlength="13"required style="margin-left:20px;width:90%" placeholder="€" style="margin-left:20px"><span class="w3-text-red"> <?php echo $precioErr;?></span></p>
    <label class="w3-text" style="margin-left:20px;color:#a7001a"><b>Fotografía</b></label>
    <input class="w3-input w3-border w3-sand" name="fileToUpload" value="<?php echo $nombreFoto?>" type="file" required style="margin-left:20px;width:90%"><span class="w3-text-red" style="margin-left:20px"><?php echo $nombreFotoErr;?></span><span class="w3-text-red"><?php echo $archivoErr; ?></span></p>
    <label class="w3-text" style="margin-left:20px;color:#a7001a"><b>Provincia de origen</b></label>
    <select class="w3-select w3-border w3-sand" style="margin-left:20px;width:90%" name='provincia' required> 


      <?php

        include ('conexion.php');

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname); //hacemos la conexion con la base de datos con los datos que pusimos arriba
        
        $consulta = "SELECT provincia,id FROM provincias GROUP BY provincia";
        $resultado = mysqli_query($conn, $consulta) or die(mysqli_error($conn));

        foreach ($resultado as $opciones) {
          # code...
          echo "<option value=" . $opciones['id'] . ">" .$opciones['provincia'] . "</option>"; 
          
        }
      	
        ?> 
  </select>
    <p>
    <button name="submit" onclick="document.getElementById('<?=$provincia?>').style.display='block'" class="w3-btn w3-highway-red" style="margin-left:20px;margin-bottom:5px ">Añadir</button></p>
    
  </form>
</div>

  
<!-- End page content -->
</div>

<!-- W3.CSS Container -->
<div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px"><p class="w3-right">Creado por <a href="https://www.linkedin.com/in/victor-torti-pina" title="W3.CSS" target="_blank" class="w3-hover-opacity">V.Torti</a></p></div>

<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
</script>

</body>
</html>
