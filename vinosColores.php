<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
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
.foto {
    background-image: url('viña.jpg');background-opacity:30%;
    margin-bottom: 10px;
    width: 100%;
  }

  .grid-item {
    border: 1px solid rgba(0, 0, 0, 0.8);
    border-radius: 5% 5%;
    background-opacity:;
  }
  
  
  .modal-contenido{
    background-image: url('arrumbador.jpg');
    opacity: 0.8;
    padding: 10px 20px;
    margin: 20% auto;
    position: relative;
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
<div class="w3-card-4 w3-section">
  <div class="w3-container w3-highway-red" style="margin-top:100px">
    <h2>Nuestros vinos</h2>
  </div>
  <div class="w3-container w3-image foto" style="width: 100%;margin-left: 0px">
  <?php
  include ('conexion.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$color=$_POST['tipo'];
$sql = "SELECT * from vinos where tipo='$color'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $_SESSION['id']=$row['idvinos'];
    $id=$row['idvinos'];
    $prov=$row['provincia'];
      ?>
  
    <?php
    if($row['tipo']=='Blanco'){
    ?>
      <div class="w3-container grid-item" style="background-color: rgba(244, 249, 129,0.8)"><p><strong><?=$row['tipo']?><br></strong>
      <?php
    }if($row['tipo']=='Tinto'){
    ?>
        <div class="w3-container grid-item" style="background-color: rgba(156, 38, 55,0.8)"><p><strong><?=$row['tipo']?><br></strong>
          <?php
    }if($row['tipo']=='Rosado'){
    ?>
    <div class="w3-container grid-item" style="background-color: rgba(223, 158, 142,0.8)"><p><strong><?=$row['tipo']?><br></strong>
          <?php
    }
    ?>
    <div  style="float: right;height: 100%; background-color: white">
        <img src="imagenes/<?=$row['imagen']?>" alt="<?=$row['nombre']?>"  style=" float:right;width: 100px;height: 200px">
      </div>
      
      <strong>ID: </strong><?=$_SESSION['id']?><br>
      <strong>Nombre: </strong><?=$row['nombre']?><br>
      <strong>Bodega: </strong><?=$row['bodega']?><br>
      
      
      <?php
        if($row['disponible']== 0){
      ?>
        <strong>Disponible:</strong> No <br>
      <?php
        }else{
      ?>
        <strong>Disponible:</strong> Si </strong><br>
      <?php
        }
      ?>

      <strong>Cosecha: </strong><?=$row['cosecha']?><br>
      <strong>EAN: </strong><?=$row['ean']?><br>
      <strong>Precio: </strong><?=$row['precio']?> €<br>
      <?php

      $sql1 = "SELECT * from provincias where id=$prov";
      $result1 = $conn->query($sql1);
      $row1 = $result1->fetch_assoc();

      ?>
      <strong>Provincia: </strong><?=$row1['provincia']?><br>
    
        
        <button onclick="document.getElementById('<?=$id?>').style.display='block'" class="w3-button w3-highway-red" style="border-radius: 15px 50px;">Pedir</button>
        <div id="<?=$id?>" class="w3-modal">
        <div class="w3-modal-content w3-animate-top w3-card-4">
          <div class="w3-container modal-contenido">
            <span onclick="document.getElementById('<?=$id?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <h2>Seleccione fecha de envío</h2>
            
            <p>      
        <form action="modificar.php" method="post">
        <input class="w3-text" style="margin-left:20px;color:#a7001a" name="numero" value="<?=$id?>" hidden></input>
        <input class="w3-input w3-border w3-sand" name="envio" type="date" style="margin-left:20px;width:90%" required></input>
        <input style="margin-left: 20px" type="submit" name="pedir" value="Pedir" class="w3-button w3-highway-red"></input>
        
        
        </form>
        </p>
          </div>
        </div>
      </div>
        
    </div>
    



        
  <?php
    }
} else {
    echo "0 results";
}
$conn->close();
  ?>
    </div>
  </div>
</p></div>

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