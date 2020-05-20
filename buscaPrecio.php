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
    background-image: url('viña.jpg');background-opacity:10%;
    margin-bottom: 10px;
    width: 100%;
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
    <h2>Busca vinos</h2>
  </div>
  <form action="consultaPrecio.php" method="post">
  <div class="w3-container w3-image foto" style="width: 100%;margin-left: 0px padding:10px">
  <p>      
    <label class="w3-text" style="margin-left:20px;color:black"><b>Precio mínimo</b></label>
    <input class="w3-input w3-border w3-sand w3-display-top" name="preciomin" type="text" required style="margin-left:20px;width:90%" required placeholder="€">
          
    <label class="w3-text" style="margin-left:20px;color:black"><b>Precio máximo</b></label>
    <input class="w3-input w3-border w3-sand w3-display-top" name="preciomax" type="text" required style="margin-left:20px;width:90%" required placeholder ="€"></p>
    <p>    
  <p>
    <input type="submit" required style="margin-left:20px" class="w3-btn w3-highway-red" value="Buscar" ></input></p>
  
  </div>
</form>
    
      
      
  
        
        
        
        
          </div>
        </div>
      </div>
        
    </div>
    



        
  
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