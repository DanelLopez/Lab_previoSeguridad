
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
	<form  method='post' id='registro' name='registro' action='registrar.php' enctype="multipart/form-data" >

    <div>
        Direccion de correo(*):<br><input type="text" name="correo" id="correo"/>
    </div>
    <div>
        Nombre y apellidos(*):<br><input type="text" name="nombre" id="nombre"/>
    </div>
    <div>
        Nick(*):<br><input type="text" name="nick" id="nick"/>
    </div>
    <div>
        Contraseña(*):<br><input type="password" name="pass" id="pass"/>
    </div>
	<div>
        Repetir contraseña(*):<br><input type="password" name="pass2" id="pass2"/>
    </div>
	<div>
		<br /><input type="submit" value="Registrar usuario" id="boton">
	</div>
	</form>
	<?php  
	if(isset($_POST['correo'])){
		//expresiones regulares 
		$no_vacio ="/^\s*$/"; //para campos obligatorios
		$form_pass ="/^[\s\S]{6,50}$/"; //pregunta minimo 6
		$form_nombre ="/(\b\w+\b)\s\1\b/"; 
 
		if(preg_match($no_vacio,$_POST['correo']) || preg_match($no_vacio,$_POST['nombre']) || preg_match($no_vacio,$_POST['nick']) 
		|| preg_match($no_vacio,$_POST['pass'])  || preg_match($no_vacio,$_POST['pass2'])) 
		{ 
		echo "Error en los datos"; 	
		echo "<p> <a href='registrar.php'> Volver a intentar </a>";
		}
		else if (preg_match($form_nombre,$_POST['nombre']) || !preg_match($form_pass,$_POST['pass'])) 
		{ 
		echo "Error en los datos";
		echo "<p> <a href='registrar.php'> Volver a intentar </a>";
		} 
		else{
			// Se conecta al SGBD 
			$iden = mysqli_connect("localhost", "id3061678_danelopez", "mibasededatos","id3061678_quiz")or die("Error: No se pudo conectar");
	
			//sentencia a ejecutar
			$sql="INSERT INTO usuarios VALUES ('$_POST[correo]','$_POST[nombre]','$_POST[nick]','$_POST[pass]')";
			if 	(!mysqli_query($iden ,$sql))
					{
					die('Error: ' . mysqli_error($iden));
					}

			echo '<script type="text/javascript"> 
			alert("usuario añadido!!");
			</script>';
			header("Location:login.php");
		
			
	mysqli_close($iden);
	}
	}	
	?> 
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
