<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="registrar.php">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span>
      		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></spam>
		<span><a href='creditos.html'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div>
	<?php 
if (isset($_POST['correo']))
{
 $Password=$_POST['pass'];
 $correo=$_POST['correo'];
 $usu = mysqli_connect("localhost", "id3061678_danelopez", "mibasededatos","id3061678_quiz")or die("Error: No se pudo conectar");
 $buscarUsuario = "SELECT * FROM usuarios WHERE Correo = '$correo' AND Password='$Password' "; 
 $result = mysqli_query($usu,$buscarUsuario); 
 $count = mysqli_num_rows($result); ; 
 if($count==0){
	echo '<script type="text/javascript"> 
	alert("Usuario/Password incorrectos");
	</script>';
	
 }else{
	 echo '<script type="text/javascript"> 
	alert("¡¡Bienvenido!!");
	</script>';
	 mysql_close($usu);
		header("Location:layout_usu.html");
 }
}
 ?><form  method='post' id='registro' name='registro' action='login.php' enctype="multipart/form-data" >

    <div>
        Direccion de correo:<br><input type="text" name="correo" id="correo"/>
    </div>
    <div>
        Contraseña:<br><input type="password" name="pass" id="pass"/>
    </div>
   
	<div>
		<br /><input type="submit" value="Acceder" id="boton">
	</div>
	</form>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
